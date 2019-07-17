<?php


namespace App\Events;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber
{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        // Recuperer l'utilisateur
        $user = $event->getUser();

        // Enrichir les data pour qu'elles contiennent ces données
        $data = $event->getData();
        $data['firstname'] = $user->getFirstname();
        $data['lastName'] = $user->getLastname();
        $data['id'] = $user->getId();

        $event->setData($data);
    }
}
