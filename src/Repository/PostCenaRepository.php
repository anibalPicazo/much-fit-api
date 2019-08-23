<?php

namespace App\Repository;

use App\Entity\PostCena;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PostCena|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostCena|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostCena[]    findAll()
 * @method PostCena[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostCenaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostCena::class);
    }

    // /**
    //  * @return PostCena[] Returns an array of PostCena objects
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
    public function findOneBySomeField($value): ?PostCena
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
