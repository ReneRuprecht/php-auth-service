<?php

namespace App\Auth\Application\Port;

use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;

interface UserRepositoryPort
{
    public function save(User $user): void;

    public function findByEmail(UserEmail $email): ?User;
}
