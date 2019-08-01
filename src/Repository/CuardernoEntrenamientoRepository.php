<?php

namespace App\Repository;

use App\Entity\CuardernoEntrenamiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CuardernoEntrenamiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method CuardernoEntrenamiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method CuardernoEntrenamiento[]    findAll()
 * @method CuardernoEntrenamiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuardernoEntrenamientoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CuardernoEntrenamiento::class);
    }

    // /**
    //  * @return CuardernoEntrenamiento[] Returns an array of CuardernoEntrenamiento objects
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
    public function findOneBySomeField($value): ?CuardernoEntrenamiento
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
