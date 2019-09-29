<?php


namespace App\Service\Managers\CuadernoEntrenamiento\HojaCuadernoEntrenamiento;


use App\DTO\CuadernoEntrenamiento\HojaCuadernoEntrenamientoCreateDTO;
use App\DTO\Entrenamiento\EntrenamientoCreateDTO;
use App\Entity\Entrenamiento;
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
        return  $this->doctrine->getRepository(HojaCuadernoRutina::class);
    }
    public function create(HojaCuadernoEntrenamientoCreateDTO $DTO){
        $hoja = new HojaCuadernoRutina();
        $hoja->setUuid($DTO->getUuid());
        $hoja->setActual(true);
        $hoja->setRutina($DTO->getRutina());
        $hoja->setCuardernoEntrenamiento($DTO->getCuadernoEntrenamiento());
        $hoja->setDesde(New \DateTime());
        $this->save($hoja);
    }
    public function addEntrenamiento(Entrenamiento $entrenamiento){
        /** @var HojaCuadernoRutina $current_hoja */
        $current_hoja = $this->findBy(['actual' => true])[0];
        $current_hoja->addEntrenamiento($entrenamiento);
        //todo: Evento ?
    }

}
