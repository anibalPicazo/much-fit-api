<?php

namespace App\Repository;

use App\Entity\Dia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dia[]    findAll()
 * @method Dia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dia::class);
    }

    // /**
    //  * @return Dia[] Returns an array of Dia objects
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
    public function findOneBySomeField($value): ?Dia
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
