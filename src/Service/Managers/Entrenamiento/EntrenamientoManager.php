<?php


namespace App\Service\Managers\Entrenamiento;


use App\DTO\Entrenamiento\EntrenamientoCreateDTO;
use App\DTO\Entrenamiento\EntrenamientoLineaCreateDTO;
use App\Entity\Entrenamiento;
use App\Entity\EntrenamientoLineas;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;

class EntrenamientoManager extends AbstractManager
{

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(Entrenamiento::class);
    }
    public function create(EntrenamientoCreateDTO $DTO){
        $entrenamiento = new Entrenamiento();
        $entrenamiento->setUuid($DTO->getUuid());
        $this->save($entrenamiento);

        return $entrenamiento;
    }
    public function addLinea(EntrenamientoLineaCreateDTO $DTO){
        $entramiento_linea = new EntrenamientoLineas();
        $entramiento_linea->setEntrenamiento($DTO->getEntrenamiento());
        $entramiento_linea->setUuid($DTO->getUuid());
        $entramiento_linea->setSerie($DTO->getSerie());
        $entramiento_linea->setRepeticiones($DTO->getRepeticiones());
        $entramiento_linea->setEjercicio($DTO->getEntrenamiento());
        $entramiento_linea->setKilos($DTO->getKilos());

        $this->save($entramiento_linea);

        // $this->dispatcher->dispatch(new EntrenamientoEvent($DTO), EntrenamientoEvent::ENTRENAMIENTO_ADD_LINE_CREATED);

        return $entramiento_linea;
    }
}
