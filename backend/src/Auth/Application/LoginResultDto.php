<?php

namespace App\Auth\Application;

class LoginResultDto
{
    public function __construct(
        public readonly string $userID, public readonly string $email)
    {
    }
}
