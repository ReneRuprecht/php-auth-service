<?php

namespace App\Auth\Infrastructure\Http\Controller;

use App\Auth\Application\Port\TokenServicePort;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AuthController
{
    public function __construct(private TokenServicePort $tokenService)
    {
    }

    #[Route('/api/v1/verify', name: 'verify', methods: ['POST'])]
    public function verify(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $token = $data['token'];
        $res = $this->tokenService->validate($token);

        return new JsonResponse([
            'valid' => $res->valid,
            'userID' => $res->userID,
            'email' => $res->email,
        ], 200);
    }
}
