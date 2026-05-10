<?php

namespace App\Auth\Infrastructure\Http\Controller;

use App\Auth\Application\RegisterUserDto;
use Symfony\Component\HttpFoundation\Request;

class UserDtoMapper
{
    public static function toRegisterUserDto(Request $request): RegisterUserDto
    {
        $data = json_decode($request->getContent(), true);

        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        return new RegisterUserDto(
            $email, $password
        );
    }
}
