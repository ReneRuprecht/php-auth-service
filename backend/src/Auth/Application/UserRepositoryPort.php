<?php

namespace App\Auth\Application;

use App\Auth\Domain\User;

interface UserRepositoryPort
{
  public function save(User $user): void;
  public function findByEmail(string $email): ?User;
}
