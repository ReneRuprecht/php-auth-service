<?php

namespace App\Auth\Infrastructure\Http\Controller;

use App\Auth\Application\RegisterUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController
{
    public function __construct(private RegisterUser $registerUser)
    {
    }

    #[Route('/api/v1/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $dto = UserDtoMapper::toRegisterUserDto($request);

        $this->registerUser->execute($dto);

        return new JsonResponse([
            'status' => 'created',
        ], 201);
    }
}
