<?php

namespace App\Tests\Unit\Auth\Domain;

use App\Auth\Domain\Exception\InvalidPasswordException;
use App\Auth\Domain\UserPassword;
use PHPUnit\Framework\TestCase;

class UserPasswordTest extends TestCase
{
    public function testFromHash(): void
    {
        $password = UserPassword::fromHash('test');
        $this->assertEquals('test', $password->value());
    }

    public function testThrowsOnEmptyPassword(): void
    {
        $this->expectException(InvalidPasswordException::class);

        UserPassword::fromHash('');
    }
}
