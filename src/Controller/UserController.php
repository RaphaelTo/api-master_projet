<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\Subscription;
use App\Entity\User;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


class UserController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/user/me")
     * @Rest\View(serializerGroups={"getUserMe"})
     */
    public function apiGetMe()
    {
        return $this->view($this->getUser());
    }

    /**
     * @Rest\Patch("/api/user")
     * @Rest\View(serializerGroups={"updateUserMe"})
     */
    public function apiPatchMe(Request $request, EntityManagerInterface $em, SubscriptionRepository $subscriptionRepository)
    {
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $address = $request->get('address');
        $country = $request->get('country');
        $subscription = $request->get('subscription')['id'];
        dd($nameCard= $request->get('cards'));

        if($firstname !== null){
            $this->getUser()->setFirstname($firstname);
        }
        if($lastname !== null){
            $this->getUser()->setLastname($lastname);
        }
        if($address !== null){
            $this->getUser()->setAddress($address);
        }
        if($country !== null){
            $this->getUser()->setCountry($country);
        }
        if($subscription !== null){
            $findSub = $subscriptionRepository->find($subscription);
            $this->getUser()->setSubscription($findSub);
        }
        $this->getUser()->setEmail($this->getUser()->getEmail());
        $em->persist($this->getUser());
        $em->flush();

        return $this->view($this->getUser());
    }

    /**
     * @Rest\Get("/api/user/card")
     * @Rest\View(serializerGroups={"getUserMe"})
     */
    public function apiGetAllCard()
    {
        return $this->view($this->getUser()->getCards());
    }

    /**
     * @Rest\Get("/api/user/card/{id}")
     * @Rest\View(serializerGroups={"getUserMe"})
     */
    public function apiGetOneCard(User $user)
    {
        return $this->view($user->getCards()->getValues());
    }

    /**
     * @Rest\Post("/api/user/card")
     * @ParamConverter("card", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"getUserMe"})
     */
    public function apiPostAddCard(Card $card, EntityManagerInterface $entityManager)
    {
        $card->setUser($this->getUser());
        $entityManager->persist($card);
        $entityManager->flush();
        return $this->view($card);
    }

    /**
     * @Rest\Patch("/api/user/card/{id}")
     * @Rest\View(serializerGroups={"getUserMe"})
     */
    public function apiPatchCardMe(Card $card, Request $request, EntityManagerInterface $entityManager )
    {
        $name = $request->get('name');
        $creditCardType = $request->get('creditCardType');
        $creditCardNumber = $request->get('creditCardNumber');
        $currencyCode = $request->get('currencyCode');
        $value = $request->get('value');

        if($name !== null){
            $card->setName($name);
        }
        if($creditCardNumber !== null){
            $card->setName($creditCardNumber);
        }
        if($creditCardType !== null){
            $card->setName($creditCardType);
        }
        if($currencyCode !== null){
            $card->setName($currencyCode);
        }
        if($value !== null){
            $card->setName($value);
        }
        $entityManager->persist($card);
        $entityManager->flush();
        return $this->view($card);

    }

    /**
     * @Rest\Delete("/api/user/card/delete/{id}")
     * @Rest\View(serializerGroups={"getUserMe"})
     */
    public function apiDeleteCard(Card $card, EntityManagerInterface $entityManager){
        dd($card);
        $entityManager->remove($card);
        $entityManager->flush();
        return $this->view($card);
    }
}
