<?php

namespace App\Repository;

use App\Entity\PasabocasDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PasabocasDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method PasabocasDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method PasabocasDieta[]    findAll()
 * @method PasabocasDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasabocasDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PasabocasDieta::class);
    }

    // /**
    //  * @return PasabocasDieta[] Returns an array of PasabocasDieta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PasabocasDieta
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
