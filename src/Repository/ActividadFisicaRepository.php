<?php

namespace App\Repository;

use App\Entity\ActividadFisica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ActividadFisica|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActividadFisica|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActividadFisica[]    findAll()
 * @method ActividadFisica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActividadFisicaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActividadFisica::class);
    }

    // /**
    //  * @return ActividadFisica[] Returns an array of ActividadFisica objects
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
    public function findOneBySomeField($value): ?ActividadFisica
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
