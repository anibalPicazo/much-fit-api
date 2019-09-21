<?php


namespace App\Service\Managers\CuadernoEntrenamiento\HojaCuadernoEntrenamiento;


use App\DTO\CuadernoEntrenamiento\HojaCuadernoEntrenamientoCreateDTO;
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
    public function create(HojaCuadernoEntrenamientoCreateDTO $DTO){
        $hoja = new HojaCuadernoRutina();
        $hoja->setUuid($DTO->getUuid());
        $hoja->setActual(true);
        $hoja->setRutina($DTO->getRutina());
        $hoja->setCuardernoEntrenamiento($DTO->getCuadernoEntrenamiento());
        $hoja->setDesde(New \DateTime());
    }
}
