<?php


namespace App\Service\Managers\Entrenamiento;

use App\EventSubscriber\Event\EntrenamientoEvent;
use App\EventSubscriber\Event\PresupuestoEvent;
use Ramsey\Uuid\Uuid;
use App\DTO\CuadernoEntrenamiento\CuadernoEntrenamientoCreateDTO;
use App\DTO\Entrenamiento\EntrenamientoCreateDTO;
use App\DTO\Entrenamiento\EntrenamientoLineaCreateDTO;
use App\Entity\Entrenamiento;
use App\Entity\EntrenamientoLineas;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;
use GuzzleHttp\Psr7\Request;

class EntrenamientoManager extends AbstractManager
{

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(Entrenamiento::class);
    }
    /**
     * @return object|string
     */
    public function getCurrent()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    public function create(EntrenamientoCreateDTO $DTO){
        $entrenamiento = new Entrenamiento();
        $entrenamiento->setUuid($DTO->getUuid());
        $DTO->getDescripcion() ? $entrenamiento->setDescripcion($DTO->getDescripcion()) : null;
        $entrenamiento->setUser($this->getCurrent());



        $this->save($entrenamiento);

        $this->dispatcher->dispatch(new EntrenamientoEvent($DTO), EntrenamientoEvent::ENTRENAMIENTO_CREATED);

        //TODO: Lllamar al evento para que este entrenamiento lo añada a la hoja de entrenamiento ACTUAL

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
