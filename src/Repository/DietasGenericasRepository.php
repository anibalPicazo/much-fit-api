<?php

namespace App\Repository;

use App\Entity\DietasGenericas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DietasGenericas|null find($id, $lockMode = null, $lockVersion = null)
 * @method DietasGenericas|null findOneBy(array $criteria, array $orderBy = null)
 * @method DietasGenericas[]    findAll()
 * @method DietasGenericas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DietasGenericasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DietasGenericas::class);
    }

    // /**
    //  * @return DietasGenericas[] Returns an array of DietasGenericas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DietasGenericas
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
