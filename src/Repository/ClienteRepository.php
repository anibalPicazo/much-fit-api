<?php

namespace App\Repository;

use App\DTO\Cliente\ClienteListarDTO;
use App\DTO\Cliente\ClienteVisitasDTO;
use App\Entity\Cliente;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function findByClienteListarDTO(User $user)
    {
        $builder = $this->createQueryBuilder('cliente')
            ->join('cliente.empresa', 'empresa')
            ->where('empresa = :empresa')
            ->setParameter('empresa', $user->getEmpresa())
            ->orderBy('cliente.createdAt', 'DESC');
        ;

        $query = $builder->getQuery();
        return $query->getResult();

    }

    /**
     * @param ClienteVisitasDTO $DTO
     * @return mixed
     */
    public function findClienteVisitasByDTO(ClienteVisitasDTO $DTO)
    {
        $cliente = $DTO->getCliente();

        $builder = $this->createQueryBuilder('cliente')
            ->join('cliente.visitas', 'visita')
            ->where('cliente = :cliente')
            ->setParameters(['cliente' => $cliente]);

        if ($DTO->getFrom()) {
            $builder->andWhere('visita.desde >= :from');
        }
        if ($DTO->getTo()) {
            $builder->andWhere('visita.hasta <= :to');
        }

        $query = $builder->getQuery();
        return $query->getResult();
    }

}
