<?php

namespace App\Auth\Infrastructure\Security;

use App\Auth\Application\PasswordHasherPort;

class BcryptPasswordHasher implements PasswordHasherPort
{
    public function hash(string $plain): string
    {
        return password_hash($plain, PASSWORD_BCRYPT);
    }

    public function verify(string $plain, string $hash): bool
    {
        return password_verify($plain, $hash);
    }
}
