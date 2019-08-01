<?php

namespace App\Repository;

use App\Entity\Alimentos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Alimentos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alimentos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alimentos[]    findAll()
 * @method Alimentos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimentosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Alimentos::class);
    }

    // /**
    //  * @return Alimentos[] Returns an array of Alimentos objects
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
    public function findOneBySomeField($value): ?Alimentos
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
