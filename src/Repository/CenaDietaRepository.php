<?php

namespace App\Repository;

use App\Entity\CenaDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CenaDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method CenaDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method CenaDieta[]    findAll()
 * @method CenaDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CenaDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CenaDieta::class);
    }

    // /**
    //  * @return CenaDieta[] Returns an array of CenaDieta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CenaDieta
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
