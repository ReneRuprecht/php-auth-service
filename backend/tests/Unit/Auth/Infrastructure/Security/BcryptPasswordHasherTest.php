<?php

namespace App\Tests\Unit\Auth\Infrastructure\Security;

use App\Auth\Infrastructure\Security\BcryptPasswordHasher;
use PHPUnit\Framework\TestCase;

class BcryptPasswordHasherTest extends TestCase
{
    public function testHash(): void
    {
        $plain = 'password';

        $hasher = new BcryptPasswordHasher();

        $hash = $hasher->hash($plain);

        $this->assertNotEquals($plain, $hash);
    }

    public function testVerify(): void
    {
        $hasher = new BcryptPasswordHasher();

        $plain = 'password';
        $hash = $hasher->hash($plain);

        $result = $hasher->verify($plain, $hash);

        $this->assertNotEquals($plain, $hash);
        $this->assertTrue($result);
    }
}
