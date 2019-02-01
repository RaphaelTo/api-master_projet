<?php

namespace App\Repository;

use App\Entity\Subsciption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subsciption|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subsciption|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subsciption[]    findAll()
 * @method Subsciption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubsciptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subsciption::class);
    }

    // /**
    //  * @return Subsciption[] Returns an array of Subsciption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subsciption
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
