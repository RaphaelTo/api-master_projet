<?php

namespace App\Controller;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class AnonymousController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/anonymous/allSub")
     * @Rest\View(serializerGroups={"sub"})
     */
    public function getApiSub(SubscriptionRepository $subscriptionRepository)
    {
         $sub = $subscriptionRepository->findAll();
         return $this->view($sub);
    }

}
