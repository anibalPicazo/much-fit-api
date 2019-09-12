<?php

namespace App\Repository;

use App\Entity\TipoFisico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TipoFisico|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoFisico|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoFisico[]    findAll()
 * @method TipoFisico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoFisicoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TipoFisico::class);
    }

    // /**
    //  * @return TipoFisico[] Returns an array of TipoFisico objects
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
    public function findOneBySomeField($value): ?TipoFisico
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
