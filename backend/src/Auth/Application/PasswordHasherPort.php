<?php

namespace App\Auth\Application;

interface PasswordHasherPort
{
    public function hash(string $plain): string;

    public function verify(string $plain, string $hash): bool;
}
