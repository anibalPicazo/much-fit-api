<?php

namespace App\Repository;

use App\Entity\DesayunoDieta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DesayunoDieta|null find($id, $lockMode = null, $lockVersion = null)
 * @method DesayunoDieta|null findOneBy(array $criteria, array $orderBy = null)
 * @method DesayunoDieta[]    findAll()
 * @method DesayunoDieta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesayunoDietaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DesayunoDieta::class);
    }

    // /**
    //  * @return DesayunoDieta[] Returns an array of DesayunoDieta objects
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
    public function findOneBySomeField($value): ?DesayunoDieta
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
