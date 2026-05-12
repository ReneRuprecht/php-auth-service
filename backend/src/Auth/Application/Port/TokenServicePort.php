<?php

namespace App\Auth\Application\Port;

use App\Auth\Application\Dto\AuthValidationResult;
use App\Auth\Domain\User;

interface TokenServicePort
{
    public function create(User $user): string;

    public function validate(string $token): AuthValidationResult;
}
