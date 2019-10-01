<?php


namespace App\EventSubscriber\Subscriber;


use App\EventSubscriber\Event\RutinaEvent;
use App\EventSubscriber\Event\UserEvent;
use App\Service\Events\EventStore;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RutinaSubscriber implements EventSubscriberInterface
{
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * UserSubscriber constructor.
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
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
        return [
            RutinaEvent::RUTINA_CREATED => 'onRutinaCreated',
            RutinaEvent::RUTINA_ASIGNATED => 'onRutinaAsignated'
        ];
    }

    public function onRutinaAsignated(RutinaEvent $event)
    {
        $this->eventStore->saveEvent(RutinaEvent::RUTINA_ASIGNATED, $event->getDTO());

    }

    public function onRutinaCreated(RutinaEvent $event)
    {
        $this->eventStore->saveEvent(RutinaEvent::RUTINA_CREATED, $event->getDTO());
    }
}
