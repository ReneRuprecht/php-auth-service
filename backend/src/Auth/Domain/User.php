<?php

namespace App\Auth\Domain;

use Symfony\Component\Uid\UuidV7;

class User
{
    public function __construct(
        private UuidV7 $id,
        private string $email,
        private string $password,
    ) {
    }

    public function getId(): UuidV7
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
