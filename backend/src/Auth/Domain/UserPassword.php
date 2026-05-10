<?php

namespace App\Auth\Domain;

use App\Auth\Domain\Exception\InvalidPasswordException;

class UserPassword
{
    private function __construct(private string $hash)
    {
    }

    /**
     * @throws InvalidPasswordException
     */
    public static function fromHash(string $hash): self
    {
        if ('' == trim($hash)) {
            throw new InvalidPasswordException();
        }

        return new self($hash);
    }

    public function value(): string
    {
        return $this->hash;
    }
}
