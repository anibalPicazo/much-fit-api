<?php

namespace App\Repository;

use App\Entity\DiaEjercicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DiaEjercicio|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiaEjercicio|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiaEjercicio[]    findAll()
 * @method DiaEjercicio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiaEjercicioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DiaEjercicio::class);
    }

    // /**
    //  * @return DiaEjercicio[] Returns an array of DiaEjercicio objects
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
    public function findOneBySomeField($value): ?DiaEjercicio
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
