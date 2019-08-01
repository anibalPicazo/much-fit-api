<?php

namespace App\Repository;

use App\Entity\AlmuerzoDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AlmuerzoDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlmuerzoDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlmuerzoDieta[]    findAll()
 * @method AlmuerzoDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlmuerzoDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AlmuerzoDieta::class);
    }

    // /**
    //  * @return AlmuerzoDieta[] Returns an array of AlmuerzoDieta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AlmuerzoDieta
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
