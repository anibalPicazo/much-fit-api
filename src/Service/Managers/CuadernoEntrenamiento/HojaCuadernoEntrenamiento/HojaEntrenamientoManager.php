<?php


namespace App\Service\Managers\CuadernoEntrenamiento\HojaCuadernoEntrenamiento;


use App\Entity\HojaCuadernoRutina;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;

class HojaEntrenamientoManager extends AbstractManager
{

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        // TODO: Implement getRepository() method.
        return  $this->doctrine->getRepository(HojaCuadernoRutina::class);
    }
}
