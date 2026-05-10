<?php

namespace App\Tests\Unit\Auth\Application;

use App\Auth\Application\LoginUser;
use App\Auth\Application\LoginUserDto;
use App\Auth\Application\PasswordHasherPort;
use App\Auth\Application\TokenServicePort;
use App\Auth\Application\UserRepositoryPort;
use App\Auth\Domain\Exception\InvalidCredentialsException;
use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserID;
use App\Auth\Domain\UserPassword;
use PHPUnit\Framework\TestCase;

class LoginUserTest extends TestCase
{
    public function testLoginUser(): void
    {
        $uid = UserID::newUserID();
        $email = UserEmail::fromString('test@example.com');
        $password = UserPassword::fromHash('hashed');
        $user = new User($uid, $email, $password);

        $dto = new LoginUserDto($email->value(), 'password');

        $repo = $this->createMock(UserRepositoryPort::class);
        $hasher = $this->createMock(PasswordHasherPort::class);
        $tokenService = $this->createMock(TokenServicePort::class);

        $repo->expects($this->once())->method('findByEmail')->with($email)->willReturn($user);
        $hasher->expects($this->once())->method('verify')->with($dto->password, $user->getPassword())->willReturn(true);
        $tokenService->expects($this->once())->method('create')->willReturn('fake-token');

        $useCase = new LoginUser($repo, $hasher, $tokenService);

        $useCase->execute($dto);
    }

    public function testThrowsInvalidCredentialsExceptionOnMissingUser(): void
    {
        $email = UserEmail::fromString('test@example.com');
        $dto = new LoginUserDto('test@example.com', 'password');

        $repo = $this->createMock(UserRepositoryPort::class);
        $hasher = $this->createMock(PasswordHasherPort::class);
        $tokenService = $this->createMock(TokenServicePort::class);

        $repo->expects($this->once())->method('findByEmail')->with($email)->willReturn(null);
        $hasher->expects($this->never())->method('verify');
        $tokenService->expects($this->never())->method('create');

        $useCase = new LoginUser($repo, $hasher, $tokenService);

        $this->expectException(InvalidCredentialsException::class);

        $useCase->execute($dto);
    }

    public function testThrowsInvalidCredentialsExceptionOnIncorrectPassword(): void
    {
        $uid = UserID::newUserID();
        $email = UserEmail::fromString('test@example.com');
        $password = UserPassword::fromHash('hashed');
        $user = new User($uid, $email, $password);

        $dto = new LoginUserDto('test@example.com', 'password');

        $repo = $this->createMock(UserRepositoryPort::class);
        $hasher = $this->createMock(PasswordHasherPort::class);
        $tokenService = $this->createMock(TokenServicePort::class);

        $repo->expects($this->once())->method('findByEmail')->with($email)->willReturn($user);
        $hasher->expects($this->once())->method('verify')->with($dto->password, $user->getPassword())->willReturn(false);
        $tokenService->expects($this->never())->method('create');

        $useCase = new LoginUser($repo, $hasher, $tokenService);

        $this->expectException(InvalidCredentialsException::class);

        $useCase->execute($dto);
    }
}
