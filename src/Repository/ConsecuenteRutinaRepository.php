<?php

namespace App\Repository;

use App\Entity\ConsecuenteRutina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ConsecuenteRutina|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsecuenteRutina|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsecuenteRutina[]    findAll()
 * @method ConsecuenteRutina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsecuenteRutinaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ConsecuenteRutina::class);
    }

    // /**
    //  * @return ConsecuenteRutina[] Returns an array of ConsecuenteRutina objects
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
    public function findOneBySomeField($value): ?ConsecuenteRutina
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
