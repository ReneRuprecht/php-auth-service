<?php

namespace App\Auth\Infrastructure\Http\Controller;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AsEventListener(event: 'kernel.exception')]
class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        $response = match (true) {
            $e instanceof \InvalidArgumentException => new JsonResponse(['error' => $e->getMessage()], 400) ,
            default => new JsonResponse(['error' => 'Internal Server Error'], 500) ,
        };

        $event->setResponse($response);
    }
}
