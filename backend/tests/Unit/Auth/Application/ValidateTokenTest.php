<?php

namespace App\Tests\Unit\Auth\Application;

use App\Auth\Application\Dto\AuthValidationResult;
use App\Auth\Application\Port\TokenServicePort;
use App\Auth\Application\ValidateToken;
use PHPUnit\Framework\TestCase;

class ValidateTokenTest extends TestCase
{
    public function testValidateToken(): void
    {
        $tokenService = $this->createMock(TokenServicePort::class);

        $token = 'demo-token';
        $authValidationResult = AuthValidationResult::valid('123', 'test@example.com');

        $tokenService->expects($this->once())->method('validate')->with('demo-token')->willReturn($authValidationResult);

        $useCase = new ValidateToken($tokenService);

        $res = $useCase->execute($token);

        $this->assertTrue($res->valid);
        $this->assertEquals('123', $res->userID);
        $this->assertEquals('test@example.com', $res->email);
    }
}
