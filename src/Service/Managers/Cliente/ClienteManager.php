<?php

namespace App\Service\Managers\Cliente;

use App\DTO\Cliente\ClienteCreateDTO;
use App\Entity\Cliente;
use App\Service\Managers\AbstractManager;


class ClienteManager extends AbstractManager
{

    /**
     * @param ClienteCreateDTO $DTO
     * @return Cliente
     */
    public function createCliente(ClienteCreateDTO $DTO)
    {
        $cliente = new Cliente();
        $cliente->setNombre($DTO->getNombre());
        $cliente->setUuid($DTO->getUuid());

        /** @var User $user */
        $current_user = $this->tokenStorage->getToken()->getUser();
        $cliente->setEmpresa($current_user->getEmpresa());

        $this->save($cliente);

        return $cliente;
    }


    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(Cliente::class);
    }
}
