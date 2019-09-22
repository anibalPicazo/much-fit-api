<?php


namespace App\Service\Managers\CuadernoEntrenamiento;


use App\DTO\CuadernoEntrenamiento\CuadernoEntrenamientoCreateDTO;
use App\Entity\CuadernoEntrenamiento;
use App\Entity\Entrenamiento;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;

class CuadernoEntrenamientoManager extends AbstractManager
{
    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(CuadernoEntrenamiento::class);
    }
    public function create(CuadernoEntrenamientoCreateDTO $DTO){
        $cuaderno = new CuadernoEntrenamiento();
        $cuaderno->setUsuario($this->getCurrent());
        $cuaderno->setUuid($DTO->getUuid());

        $this->save($cuaderno);
        return $cuaderno;
        //todo: Lanzar el evento de cuaderno creado
    }
}
