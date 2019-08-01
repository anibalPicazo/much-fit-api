<?php

namespace App\Repository;

use App\Entity\CategoriaAlimentos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoriaAlimentos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriaAlimentos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriaAlimentos[]    findAll()
 * @method CategoriaAlimentos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriaAlimentosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoriaAlimentos::class);
    }

    // /**
    //  * @return CategoriaAlimentos[] Returns an array of CategoriaAlimentos objects
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
    public function findOneBySomeField($value): ?CategoriaAlimentos
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
