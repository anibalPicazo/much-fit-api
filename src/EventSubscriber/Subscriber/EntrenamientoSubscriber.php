<?php


namespace App\EventSubscriber\Subscriber;


use App\DTO\CuadernoEntrenamiento\CuadernoEntrenamientoCreateDTO;
use App\DTO\CuadernoEntrenamiento\HojaCuadernoEntrenamientoCreateDTO;
use App\Entity\Entrenamiento;
use App\Entity\HojaCuadernoRutina;
use App\Entity\User;
use App\EventSubscriber\Event\EntrenamientoEvent;
use App\Service\Events\EventStore;
use App\Service\Managers\AbstractManager;
use App\Service\Managers\CuadernoEntrenamiento\CuadernoEntrenamientoManager;
use App\Service\Managers\CuadernoEntrenamiento\HojaCuadernoEntrenamiento\HojaEntrenamientoManager;
use App\Service\Managers\Entrenamiento\EntrenamientoManager;
use App\Service\Managers\User\UserManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EntrenamientoSubscriber implements EventSubscriberInterface
{
    /**
     * @var EventStore
     */
    private $eventStore;
    /**
     * @var CuadernoEntrenamientoManager
     */
    private $cuadernoEntrenamientoManager;
    /**
     * @var HojaEntrenamientoManager
     */
    private $hojaCuadernoManager;
    /**
     * @var EntrenamientoManager
     */
    private $entrenamientoManager;
    /**
     * @var UserManager
     */
    private $userManager;


    /**
     * EntrenamientoSubscriber constructor.
     * @param EventStore $eventStore
     * @param CuadernoEntrenamientoManager $cuadernoEntrenamientoManager
     * @param HojaEntrenamientoManager $hojaCuadernoManager
     * @param EntrenamientoManager $entrenamientoManager
     */
    public function __construct(EventStore $eventStore,CuadernoEntrenamientoManager $cuadernoEntrenamientoManager,HojaEntrenamientoManager $hojaCuadernoManager, EntrenamientoManager $entrenamientoManager,UserManager $userManager)
    {
        $this->eventStore = $eventStore;
        $this->cuadernoEntrenamientoManager = $cuadernoEntrenamientoManager;
        $this->hojaCuadernoManager = $hojaCuadernoManager;
        $this->entrenamientoManager = $entrenamientoManager;
        $this->userManager = $userManager;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
       return  [EntrenamientoEvent::ENTRENAMIENTO_CREATED => 'onEntrenamientoCreate'];
    }
    public function onEntrenamientoCreate(EntrenamientoEvent $event){

        $this->eventStore->saveEvent(EntrenamientoEvent::ENTRENAMIENTO_CREATED,$event->getDTO());

        /** @var User $user */
        $user = $event->getDTO()->getUser();


        $cuaderno = $this->cuadernoEntrenamientoManager->findBy(['usuario' => $user]);

        if(count($cuaderno) == 0){
            $DTO = new CuadernoEntrenamientoCreateDTO(Uuid::uuid4());
            $cuaderno_created = $this->cuadernoEntrenamientoManager->create($DTO);
            $hojaEntrenamientoDTO = new HojaCuadernoEntrenamientoCreateDTO(Uuid::uuid4(),$event->getDTO()->getRutina(),$cuaderno_created);
            $this->hojaCuadernoManager->create($hojaEntrenamientoDTO);
            $this->addEntrenamiento($event->getDTO()->getUuid());

        }
        else{
            $hojas = $this->hojaCuadernoManager->findBy(['cuaderno_entrenamiento' => $user->getCuardernoEntrenamiento()]);
            if(count($hojas) == 0) {
                $hojaEntrenamientoDTO = new HojaCuadernoEntrenamientoCreateDTO(Uuid::uuid4(), $user->getRutina()->getUuid(), $user->getCuardernoEntrenamiento()->getUuid());
                $this->hojaCuadernoManager->create($hojaEntrenamientoDTO);
                $this->addEntrenamiento($event->getDTO()->getUuid());
            } else{
                    $this->addEntrenamiento($event->getDTO()->getUuid());
                }
            }
        }
        public function addEntrenamiento(String $idEntrenamiento) {
            /** @var Entrenamiento $entrenamiento */
            $entrenamiento = $this->entrenamientoManager->findBy(['uuid' => $idEntrenamiento])[0];
            $this->hojaCuadernoManager->addEntrenamiento($entrenamiento);
        }
}
