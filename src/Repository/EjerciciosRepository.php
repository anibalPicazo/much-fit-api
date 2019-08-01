<?php

namespace App\Repository;

use App\Entity\Ejercicios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ejercicios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ejercicios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ejercicios[]    findAll()
 * @method Ejercicios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EjerciciosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ejercicios::class);
    }

    // /**
    //  * @return Ejercicios[] Returns an array of Ejercicios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ejercicios
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
