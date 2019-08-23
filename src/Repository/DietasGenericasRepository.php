<?php

namespace App\Repository;

use App\Entity\Dieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dieta[]    findAll()
 * @method Dieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DietasGenericasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dieta::class);
    }

    // /**
    //  * @return Dieta[] Returns an array of Dieta objects
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
    public function findOneBySomeField($value): ?Dieta
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
