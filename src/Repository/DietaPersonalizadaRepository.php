<?php

namespace App\Repository;

use App\Entity\DietaPersonalizada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DietaPersonalizada|null find($id, $lockMode = null, $lockVersion = null)
 * @method DietaPersonalizada|null findOneBy(array $criteria, array $orderBy = null)
 * @method DietaPersonalizada[]    findAll()
 * @method DietaPersonalizada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DietaPersonalizadaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DietaPersonalizada::class);
    }

    // /**
    //  * @return DietaPersonalizada[] Returns an array of DietaPersonalizada objects
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
    public function findOneBySomeField($value): ?DietaPersonalizada
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
