<?php

namespace App\Health\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HealthController extends AbstractController
{

  #[Route(path: '/health', name: 'health', methods: ['GET'])]
  public function health(): JsonResponse
  {
    return new JsonResponse(
      [
        'status' => 'ok',
        'service' => 'auth-service',
        'timestamp' => time()
      ],
      Response::HTTP_OK
    );
  }
}
