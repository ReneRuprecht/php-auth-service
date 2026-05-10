<?php

namespace App\Auth\Infrastructure\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class JwtUser implements UserInterface
{
    public function __construct(
        public readonly string $userId,
        public readonly string $email,
        private array $roles = [],
    ) {
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
