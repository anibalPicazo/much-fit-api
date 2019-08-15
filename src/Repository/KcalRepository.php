<?php

namespace App\Repository;

use App\Entity\Kcal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Kcal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kcal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kcal[]    findAll()
 * @method Kcal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KcalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Kcal::class);
    }

    // /**
    //  * @return Kcal[] Returns an array of Kcal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kcal
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
