<?php

namespace App\Repository;

use App\Entity\MarcaAlimento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MarcaAlimento|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarcaAlimento|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarcaAlimento[]    findAll()
 * @method MarcaAlimento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarcaAlimentoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MarcaAlimento::class);
    }

    // /**
    //  * @return MarcaAlimento[] Returns an array of MarcaAlimento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MarcaAlimento
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
