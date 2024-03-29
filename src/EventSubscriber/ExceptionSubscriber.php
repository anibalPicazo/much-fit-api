<?php


namespace App\EventSubscriber;

use Google\Cloud\ErrorReporting\Bootstrap;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [];
//        return [
//            KernelEvents::EXCEPTION => [
//                ['logException', 0]
//            ]
//        ];
    }

    public function logException(ExceptionEvent $event)
    {
        $exception = $event->getException();
        Bootstrap::exceptionHandler($exception);
    }

}
