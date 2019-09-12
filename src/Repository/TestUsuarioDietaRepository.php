<?php

namespace App\Repository;

use App\Entity\TestUsuarioDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TestUsuarioDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestUsuarioDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestUsuarioDieta[]    findAll()
 * @method TestUsuarioDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestUsuarioDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TestUsuarioDieta::class);
    }

    // /**
    //  * @return TestUsuarioDieta[] Returns an array of TestUsuarioDieta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TestUsuarioDieta
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
