<?php

namespace App\Repository;

use App\Entity\PostCenaDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PostCenaDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostCenaDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostCenaDieta[]    findAll()
 * @method PostCenaDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostCenaDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostCenaDieta::class);
    }

    // /**
    //  * @return PostCenaDieta[] Returns an array of PostCenaDieta objects
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
    public function findOneBySomeField($value): ?PostCenaDieta
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
