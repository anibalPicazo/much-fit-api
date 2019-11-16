<?php

namespace App\Repository;

use App\Entity\PremisasRutina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PremisasRutina|null find($id, $lockMode = null, $lockVersion = null)
 * @method PremisasRutina|null findOneBy(array $criteria, array $orderBy = null)
 * @method PremisasRutina[]    findAll()
 * @method PremisasRutina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PremisasRutinaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PremisasRutina::class);
    }

    // /**
    //  * @return PremisasRutina[] Returns an array of PremisasRutina objects
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
    public function findOneBySomeField($value): ?PremisasRutina
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
