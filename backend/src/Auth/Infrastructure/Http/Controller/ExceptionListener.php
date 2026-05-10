<?php

namespace App\Auth\Infrastructure\Http\Controller;

use App\Auth\Domain\Exception\InvalidCredentialsException;
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
            $e instanceof InvalidCredentialsException => new JsonResponse(['error' => $e->getMessage()], 401) ,
            default => new JsonResponse(['error' => 'Internal Server Error'.$e->getMessage()], 500) ,
        };

        $event->setResponse($response);
    }
}
