<?php

namespace App\Auth\Application;

use App\Auth\Domain\User;

interface TokenServicePort
{
    public function create(User $user): string;
}
