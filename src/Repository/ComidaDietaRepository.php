<?php

namespace App\Repository;

use App\Entity\ComidaDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ComidaDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComidaDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComidaDieta[]    findAll()
 * @method ComidaDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComidaDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ComidaDieta::class);
    }

    // /**
    //  * @return ComidaDieta[] Returns an array of ComidaDieta objects
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
    public function findOneBySomeField($value): ?ComidaDieta
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
