<?php

namespace App\Repository;

use App\Entity\TestUsuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TestUsuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestUsuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestUsuario[]    findAll()
 * @method TestUsuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestUsuarioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TestUsuario::class);
    }

    // /**
    //  * @return TestUsuario[] Returns an array of TestUsuario objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TestUsuario
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
