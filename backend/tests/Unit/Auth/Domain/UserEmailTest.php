<?php

namespace App\Tests\Unit\Auth\Domain;

use App\Auth\Domain\Exception\InvalidEmailException;
use App\Auth\Domain\UserEmail;
use PHPUnit\Framework\TestCase;

class UserEmailTest extends TestCase
{
    public function testFromString(): void
    {
        $email = UserEmail::fromString('test@example.com');
        $this->assertEquals('test@example.com', $email->value());
    }

    public function testThrowsOnEmptyEmail(): void
    {
        $this->expectException(InvalidEmailException::class);

        UserEmail::fromString('');
    }

    public function testThrowsOnInvalidEmail(): void
    {
        $this->expectException(InvalidEmailException::class);

        UserEmail::fromString('test.com');
    }
}
