<?php

namespace App\Repository;

use App\Entity\HojaCuadernoDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HojaCuadernoDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method HojaCuadernoDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method HojaCuadernoDieta[]    findAll()
 * @method HojaCuadernoDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HojaCuadernoDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HojaCuadernoDieta::class);
    }

    // /**
    //  * @return HojaCuadernoDieta[] Returns an array of HojaCuadernoDieta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HojaCuadernoDieta
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
