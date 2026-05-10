<?php

namespace App\Auth\Domain;

use Symfony\Component\Uid\UuidV7;

class UserID
{
    private function __construct(private string $id)
    {
    }

    public static function newUserID(): self
    {
        $id = UuidV7::generate();

        return new self($id);
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public function value(): string
    {
        return $this->id;
    }
}
