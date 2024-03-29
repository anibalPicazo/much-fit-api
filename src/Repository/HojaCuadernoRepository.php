<?php

namespace App\Repository;

use App\Entity\HojaCuadernoRutina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HojaCuadernoRutina|null find($id, $lockMode = null, $lockVersion = null)
 * @method HojaCuadernoRutina|null findOneBy(array $criteria, array $orderBy = null)
 * @method HojaCuadernoRutina[]    findAll()
 * @method HojaCuadernoRutina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HojaCuadernoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HojaCuadernoRutina::class);
    }

    // /**
    //  * @return HojaCuadernoRutina[] Returns an array of HojaCuadernoRutina objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HojaCuadernoRutina
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
