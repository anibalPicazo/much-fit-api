<?php

namespace App\Repository;

use App\Entity\IntensidadRutina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IntensidadRutina|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntensidadRutina|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntensidadRutina[]    findAll()
 * @method IntensidadRutina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntensidadRutinaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IntensidadRutina::class);
    }

    // /**
    //  * @return IntensidadRutina[] Returns an array of IntensidadRutina objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IntensidadRutina
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
