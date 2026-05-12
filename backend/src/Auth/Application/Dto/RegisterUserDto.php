<?php

namespace App\Auth\Application\Dto;

class RegisterUserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password)
    {
    }
}
