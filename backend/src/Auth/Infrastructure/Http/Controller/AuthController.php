<?php

namespace App\Auth\Infrastructure\Http\Controller;

use App\Auth\Application\RegisterUser;
use App\Auth\Application\RegisterUserDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AuthController
{
    public function __construct(private RegisterUser $registerUser)
    {
    }

    #[Route('api/v1/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $dto = new RegisterUserDto(
            $data['email'] ?? '',
            $data['password'] ?? ''
        );

        $this->registerUser->execute($dto);

        return new JsonResponse([
            'status' => 'created',
        ], 201);
    }
}
