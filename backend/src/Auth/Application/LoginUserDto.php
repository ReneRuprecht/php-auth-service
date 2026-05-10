<?php

namespace App\Auth\Application;

class LoginUserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password)
    {
    }
}
