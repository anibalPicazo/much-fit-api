<?php


namespace App\EventSubscriber\Subscriber;


use App\DTO\CuadernoEntrenamiento\CuadernoEntrenamientoCreateDTO;
use App\Entity\HojaCuadernoRutina;
use App\EventSubscriber\Event\EntrenamientoEvent;
use App\Service\Events\EventStore;
use App\Service\Managers\CuadernoEntrenamiento\CuadernoEntrenamientoManager;
use App\Service\Managers\CuadernoEntrenamiento\HojaCuadernoEntrenamiento\HojaEntrenamientoManager;
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
    private $hojaCuaderno;

    /**
     * EntrenamientoSubscriber constructor.
     * @param EventStore $eventStore
     * @param CuadernoEntrenamientoManager $cuadernoEntrenamientoManager
     * @param HojaEntrenamientoManager $hojaCuaderno
     */
    public function __construct(EventStore $eventStore,CuadernoEntrenamientoManager $cuadernoEntrenamientoManager,HojaEntrenamientoManager $hojaCuaderno)
    {
        $this->eventStore = $eventStore;
        $this->cuadernoEntrenamientoManager = $cuadernoEntrenamientoManager;
        $this->hojaCuaderno = $hojaCuaderno;
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
        [EntrenamientoEvent::ENTRENAMIENTO_CREATED => 'onEntrenamientoCreate'];
    }
    protected function onEntrenamientoCreate(EntrenamientoEvent $event){
        $this->eventStore->saveEvent(EntrenamientoEvent::ENTRENAMIENTO_CREATED,$event->getDTO());
        $user = $this->cuadernoEntrenamientoManager->getCurrent();
        $cuaderno = $this->cuadernoEntrenamientoManager->findBy(['user' => $user]);
        if(count($cuaderno) == 0){
            $DTO = new CuadernoEntrenamientoCreateDTO(Uuid::uuid4());

        }

    }
}
