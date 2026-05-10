<?php

namespace App\Auth\Domain;

class User
{
    public function __construct(
        private UserID $id,
        private UserEmail $email,
        private UserPassword $password,
    ) {
    }

    public function getUserID(): string
    {
        return $this->id->value();
    }

    public function getEmail(): string
    {
        return $this->email->value();
    }

    public function getPassword(): string
    {
        return $this->password->value();
    }
}
