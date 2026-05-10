<?php

namespace App\Auth\Domain;

use App\Auth\Domain\Exception\InvalidEmailException;

class UserEmail
{
    private function __construct(private string $email)
    {
    }

    /**
     * @throws InvalidEmailException
     */
    public static function fromString(string $email): self
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }

        return new self($email);
    }

    public function value(): string
    {
        return $this->email;
    }
}
