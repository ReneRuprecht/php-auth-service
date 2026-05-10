<?php

namespace App\Tests\Auth\Application;

use App\Auth\Application\RegisterUser;
use App\Auth\Application\RegisterUserDto;
use App\Auth\Application\UserRepositoryPort;
use PHPUnit\Framework\TestCase;

class RegisterUserTest extends TestCase
{
    public function testRegisterUser(): void
    {
        $repo = $this->createMock(UserRepositoryPort::class);

        $repo->expects($this->once())->method('save');

        $useCase = new RegisterUser($repo);

        $dto = new RegisterUserDto('test@example.com', 'password');

        $useCase->execute($dto);
    }
}
