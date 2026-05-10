<?php

namespace App\Auth\Infrastructure\Http\Controller;

use App\Auth\Application\LoginUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LoginController
{
    public function __construct(private LoginUser $loginUser)
    {
    }

    #[Route('/api/v1/login', name: 'login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        $dto = UserDtoMapper::toLoginUserDto($request);

        $result = $this->loginUser->execute($dto);

        return new JsonResponse([
            'id' => $result->userID,
            'email' => $result->email,
        ], 200);
    }
}
