<?php

namespace App\Repository;

use App\Entity\ConsecuenteNutricion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ConsecuenteNutricion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsecuenteNutricion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsecuenteNutricion[]    findAll()
 * @method ConsecuenteNutricion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsecuenteNutricionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ConsecuenteNutricion::class);
    }

    // /**
    //  * @return ConsecuenteNutricion[] Returns an array of ConsecuenteNutricion objects
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
    public function findOneBySomeField($value): ?ConsecuenteNutricion
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
