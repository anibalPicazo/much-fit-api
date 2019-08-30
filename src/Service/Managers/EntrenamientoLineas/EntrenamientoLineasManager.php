<?php


namespace App\Service\Managers\EntrenamientoLineas;


use App\DTO\Entrenamiento\EntrenamientoLineaCreateDTO;
use App\Entity\EntrenamientoLineas;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;

class EntrenamientoLineasManager extends AbstractManager
{

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        $this->doctrine->getRepository(EntrenamientoLineasManager::class);
    }
    public function create(EntrenamientoLineaCreateDTO $DTO){
        $entrenamiento_linea = new EntrenamientoLineas();
        $entrenamiento_linea->setUuid($DTO->getUuid());
        $entrenamiento_linea->setKilos($DTO->getKilos());
        $entrenamiento_linea->setRepeticiones($DTO->getRepeticiones());
        $entrenamiento_linea->setSerie($DTO->getSerie());
        $this->save($entrenamiento_linea);
        //todo: Ver presupuesto Certiapp

    }
}
