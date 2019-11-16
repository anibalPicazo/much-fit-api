<?php


namespace App\EventSubscriber\Subscriber;



use App\EventSubscriber\Event\RutinaEvent;
use App\EventSubscriber\Event\TestEntrenamientoEvent;
use App\Service\Events\EventStore;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TestEntrenamientoSubscriber implements EventSubscriberInterface
{
    /**
     * @var EventStore
     */
    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }
    public static function getSubscribedEvents()
    {
        return [
            TestEntrenamientoEvent::
            TEST_ENTRENAMIENTO_CREATE => 'onTestCreated',
        ];
    }
    public function onTestCreated(TestEntrenamientoEvent $event)
    {
        $this->eventStore->saveEvent(
            RutinaEvent::RUTINA_CREATED,
            $event->getDTO());
    }
}
