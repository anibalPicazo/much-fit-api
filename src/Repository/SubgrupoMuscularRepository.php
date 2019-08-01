<?php

namespace App\Repository;

use App\Entity\SubgrupoMuscular;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SubgrupoMuscular|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubgrupoMuscular|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubgrupoMuscular[]    findAll()
 * @method SubgrupoMuscular[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubgrupoMuscularRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SubgrupoMuscular::class);
    }

    // /**
    //  * @return SubgrupoMuscular[] Returns an array of SubgrupoMuscular objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubgrupoMuscular
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
