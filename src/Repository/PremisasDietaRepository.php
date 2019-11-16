<?php

namespace App\Repository;

use App\Entity\PremisasDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PremisasDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method PremisasDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method PremisasDieta[]    findAll()
 * @method PremisasDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PremisasDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PremisasDieta::class);
    }

    // /**
    //  * @return PremisasDieta[] Returns an array of PremisasDieta objects
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
    public function findOneBySomeField($value): ?PremisasDieta
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
