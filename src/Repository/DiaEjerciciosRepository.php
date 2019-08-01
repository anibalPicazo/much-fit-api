<?php

namespace App\Repository;

use App\Entity\DiaEjercicios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DiaEjercicios|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiaEjercicios|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiaEjercicios[]    findAll()
 * @method DiaEjercicios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiaEjerciciosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DiaEjercicios::class);
    }

    // /**
    //  * @return DiaEjercicios[] Returns an array of DiaEjercicios objects
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
    public function findOneBySomeField($value): ?DiaEjercicios
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
