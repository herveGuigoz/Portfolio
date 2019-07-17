<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Resume;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class NewResumeSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        // Definition de l'event du kernel + hook + methods a éffectuer
        // https://api-platform.com/docs/core/events/
        return [
            KernelEvents::VIEW => ['createResume', EventPriorities::PRE_WRITE]
        ];
    }

    public function createResume(GetResponseForControllerResultEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if($user instanceof User && $method === 'POST') {
            $resume = new Resume();
            $user->setResume($resume);
        }
    }
}