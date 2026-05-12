<?php

namespace App\Auth\Application\Dto;

class AuthValidationResult
{
    private function __construct(public readonly bool $valid, public readonly string $userID, public readonly string $email,
    ) {
    }

    public static function invalid(): self
    {
        return new self(false, '', '');
    }

    public static function valid(string $userID, string $email): self
    {
        return new self(true, $userID, $email);
    }
}
