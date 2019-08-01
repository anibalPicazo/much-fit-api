<?php

namespace App\Repository;

use App\Entity\EntrenamientoLineas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EntrenamientoLineas|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntrenamientoLineas|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntrenamientoLineas[]    findAll()
 * @method EntrenamientoLineas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrenamientoLineasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EntrenamientoLineas::class);
    }

    // /**
    //  * @return EntrenamientoLineas[] Returns an array of EntrenamientoLineas objects
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
    public function findOneBySomeField($value): ?EntrenamientoLineas
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
