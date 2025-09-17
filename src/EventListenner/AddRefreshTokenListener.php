<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class AddRefreshTokenCookieListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['onKernelView', 10],
        ];
    }

    public function onKernelView(ViewEvent $event): void
    {
        $request = $event->getRequest();
        $cookie = $request->attributes->get('_refreshTokenCookie');

        if ($cookie) {
            $controllerResult = $event->getControllerResult();
            $response = new JsonResponse((array) $controllerResult);
            $response->headers->setCookie($cookie);
            $event->setResponse($response);
        }
    }
}