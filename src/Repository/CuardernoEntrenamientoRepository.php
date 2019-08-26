<?php

namespace App\Repository;

use App\Entity\CuadernoEntrenamiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CuadernoEntrenamiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method CuadernoEntrenamiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method CuadernoEntrenamiento[]    findAll()
 * @method CuadernoEntrenamiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuardernoEntrenamientoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CuadernoEntrenamiento::class);
    }

    // /**
    //  * @return CuadernoEntrenamiento[] Returns an array of CuadernoEntrenamiento objects
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
    public function findOneBySomeField($value): ?CuadernoEntrenamiento
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
