<?php

namespace App\Repository;

use App\Entity\EjercicioEntrenamiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EjercicioEntrenamiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method EjercicioEntrenamiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method EjercicioEntrenamiento[]    findAll()
 * @method EjercicioEntrenamiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EjercicioEntrenamientoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EjercicioEntrenamiento::class);
    }

    // /**
    //  * @return EjercicioEntrenamiento[] Returns an array of EjercicioEntrenamiento objects
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
    public function findOneBySomeField($value): ?EjercicioEntrenamiento
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
