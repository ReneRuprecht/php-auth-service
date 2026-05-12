<?php

namespace App\Tests\Integration\Auth\Infrastructure\Security;

use App\Auth\Application\Port\TokenServicePort;
use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserID;
use App\Auth\Domain\UserPassword;
use App\Auth\Infrastructure\Security\JwtTokenService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class JwtTokenServiceTest extends KernelTestCase
{
    private TokenServicePort $service;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->service = self::getContainer()->get(JwtTokenService::class);
    }

    public function testCreateReturnValidJwt(): void
    {
        $id = UserID::fromString('123');
        $email = UserEmail::fromString('test@example.com');
        $password = UserPassword::fromHash('hashed');
        $user = new User($id, $email, $password);

        $token = $this->service->create($user);

        $this->assertNotEmpty($token);
    }

    public function testValidateValidToken(): void
    {
        $id = UserID::fromString('123');
        $email = UserEmail::fromString('test@example.com');
        $password = UserPassword::fromHash('hashed');
        $user = new User($id, $email, $password);

        $token = $this->service->create($user);

        $result = $this->service->validate($token);

        $this->assertTrue($result->valid);
        $this->assertSame('123', $result->userID);
        $this->assertSame('test@example.com', $result->email);
    }

    public function testValidateInvalidToken(): void
    {
        $result = $this->service->validate('invalid-token');

        $this->assertFalse($result->valid);
    }
}
