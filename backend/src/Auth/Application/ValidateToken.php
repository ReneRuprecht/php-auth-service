<?php

namespace App\Auth\Application;

use App\Auth\Application\Dto\AuthValidationResult;
use App\Auth\Application\Port\TokenServicePort;

class ValidateToken
{
    public function __construct(private TokenServicePort $tokenService)
    {
    }

    public function execute(string $token): AuthValidationResult
    {
        return $this->tokenService->validate($token);
    }
}
