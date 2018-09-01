<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Conversion;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ConversionPrepareSubscriber implements EventSubscriberInterface
{
    public function __construct()
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['queueConversion', EventPriorities::POST_WRITE],
        ];
    }

    public function queueConversion(GetResponseForControllerResultEvent $event)
    {
        $conversion = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$conversion instanceof Conversion || Request::METHOD_POST !== $method) {
            return;
        }

        // publish to queue code
    }
}
