<?php

namespace App\Auth\Application\Dto;

class LoginResultDto
{
    public function __construct(
        public readonly string $token)
    {
    }
}
