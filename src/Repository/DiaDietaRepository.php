<?php

namespace App\Repository;

use App\Entity\DiaDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DiaDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiaDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiaDieta[]    findAll()
 * @method DiaDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiaDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DiaDieta::class);
    }

    // /**
    //  * @return DiaDieta[] Returns an array of DiaDieta objects
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
    public function findOneBySomeField($value): ?DiaDieta
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
