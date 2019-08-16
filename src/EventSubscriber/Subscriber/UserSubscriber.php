<?php


namespace App\EventSubscriber\Subscriber;


use App\EventSubscriber\Event\UserEvent;
use App\Service\Events\EventStore;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
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

    public static function getSubscribedEvents()
    {
        return [
            UserEvent::USER_CREATED => 'onUserCreated',
            UserEvent::USER_COMPANY_DESIGNATED => 'onUserAsignated',
        ];
    }

    public function onUserCreated(UserEvent $event)
    {
        $this->eventStore->saveEvent(UserEvent::USER_CREATED, $event->getDTO());
    }

    public function onUserAsignated(UserEvent $event)
    {
        $this->eventStore->saveEvent(UserEvent::USER_COMPANY_DESIGNATED, $event->getDTO());
    }

}
