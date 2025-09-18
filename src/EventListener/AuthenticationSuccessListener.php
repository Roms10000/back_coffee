<?php

// src/EventListener/AuthenticationSuccessListener.php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $data = $event->getData();
        $response = $event->getResponse();

        $token = $data['token']; // récupéré depuis Lexik
        unset($data['token']); // on supprime pour ne pas l'envoyer en JSON
        $data['success'] = true;   // on remets quelquechose pour pouvoir envoyer quand meme un JSON

        $response->headers->setCookie(
        new Cookie(
            'jwt',
            $token,
            (new \DateTime('+1 hour'))->getTimestamp(),
            '/',
            null,
            false, // secure à false en dev
            true,  // httpOnly
            false,
            'Lax'
            )
        );

        $event->setData($data); // si tu veux encore renvoyer un JSON custom
    }
}