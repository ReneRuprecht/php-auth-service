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

    public function getUserID(): UserID
    {
        return $this->id;
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    public function getPassword(): UserPassword
    {
        return $this->password;
    }
}
