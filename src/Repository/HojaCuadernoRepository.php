<?php

namespace App\Repository;

use App\Entity\HojaCuaderno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HojaCuaderno|null find($id, $lockMode = null, $lockVersion = null)
 * @method HojaCuaderno|null findOneBy(array $criteria, array $orderBy = null)
 * @method HojaCuaderno[]    findAll()
 * @method HojaCuaderno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HojaCuadernoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HojaCuaderno::class);
    }

    // /**
    //  * @return HojaCuaderno[] Returns an array of HojaCuaderno objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HojaCuaderno
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
