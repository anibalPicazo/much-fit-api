<?php


namespace App\Service\Managers\Rutina;


use App\DTO\Rutina\AsignarRutinaDTO;
use App\DTO\Rutina\DiaCreateDTO;
use App\DTO\Rutina\DiaEjercicioCreateDTO;
use App\DTO\Rutina\RutinaCreateDTO;
use App\Entity\Dia;
use App\Entity\DiaEjercicio;
use App\Entity\Event;
use App\Entity\Rutina;
use App\Entity\User;
use App\EventSubscriber\Event\RutinaEvent;
use App\Serializer\ApiRestErrorNormalizer;
use App\Service\Events\EventStore;
use App\Service\Forms\DTOFormFactory;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class RutinaManager extends AbstractManager
{
    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(Rutina::class);
    }
    public function createRutina(RutinaCreateDTO $DTO){
        /** @var Rutina $rutina */
        $rutina = new Rutina();
        $rutina->setUuid($DTO->getUuid());
        $rutina->setDesgasteCalorico($DTO->getDesgasteCalorico());
        $rutina->setDificultadUsuario($DTO->getDificultadUsuario());
        $rutina->setFrecuencia($DTO->getFrecuencia());
        $rutina->setNombre($DTO->getNombre());
        //Todo: Serializacion de Objetivos en Base de datos.
        $rutina->setObjetivo($DTO->getObjetivos());
        $rutina->setVolumen($DTO->getVolumen());

        // $this->dispatcher(new RutinaEvent($DTO));

        $this->save($rutina);
        return $rutina;
    }
    public function createDia(DiaCreateDTO $DTO){
        /** @var Dia $dia */
        $dia = new Dia();
        $dia->setUuid($DTO->getUuid());
        $dia->setRutina($DTO->getRutina());
        $dia->setNombre($DTO->getNombre());
        $this->save($dia);
        return $dia;
    }
    public function createDiaEjercico(DiaEjercicioCreateDTO $DTO){

        /** @var DiaEjercicio $diaEjercicio */
        $diaEjercicio = new DiaEjercicio();
        $diaEjercicio->setUuid($DTO->getUuid());
        $diaEjercicio->setEjercicio($DTO->getEjercicio());
        $diaEjercicio->setRepeticiones($DTO->getRepeticiones());
        $diaEjercicio->setDescanso($DTO->getDescanso());
        $diaEjercicio->setIntensidad($DTO->getIntesidad());
        $diaEjercicio->setSeries($DTO->getSerie());
        $diaEjercicio->setDia($DTO->getDia());
        $this->save($diaEjercicio);
        return $diaEjercicio;
    }

    public function asignarRutina(AsignarRutinaDTO $DTO){
        /** @var User $user */
        $user = $DTO->getUser();
        $user->setRutina($DTO->getRutina());
        $this->save($user);
    }

}
