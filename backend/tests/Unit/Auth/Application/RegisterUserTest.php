<?php

namespace App\Tests\Auth\Application;

use App\Auth\Application\Dto\RegisterUserDto;
use App\Auth\Application\Port\PasswordHasherPort;
use App\Auth\Application\Port\UserRepositoryPort;
use App\Auth\Application\RegisterUser;
use PHPUnit\Framework\TestCase;

class RegisterUserTest extends TestCase
{
    public function testRegisterUser(): void
    {
        $repo = $this->createMock(UserRepositoryPort::class);
        $hasher = $this->createMock(PasswordHasherPort::class);

        $repo->expects($this->once())->method('save');
        $hasher->expects($this->once())->method('hash')->with('password')->willReturn('hashed');

        $useCase = new RegisterUser($repo, $hasher);

        $dto = new RegisterUserDto('test@example.com', 'password');

        $useCase->execute($dto);
    }

    public function testThrowsOnEmptyPassword(): void
    {
        $repo = $this->createMock(UserRepositoryPort::class);
        $hasher = $this->createMock(PasswordHasherPort::class);

        $repo->expects($this->never())->method('save');
        $hasher->expects($this->never())->method('hash');

        $useCase = new RegisterUser($repo, $hasher);

        $dto = new RegisterUserDto('test@example.com', '');

        $this->expectException(\InvalidArgumentException::class);

        $useCase->execute($dto);
    }
}
