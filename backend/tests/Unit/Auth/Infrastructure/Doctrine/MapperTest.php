<?php

namespace App\Tests\Auth\Infrastructure\Doctrine;

use App\Auth\Domain\User;
use App\Auth\Infrastructure\Doctrine\UserEntity;
use App\Auth\Infrastructure\Doctrine\UserMapper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class MapperTest extends TestCase
{
    public function testToDomain(): void
    {
        $entity = new UserEntity();
        $entity->id = Uuid::v7();
        $entity->email = 'test@example.com';
        $entity->password = 'password';

        $user = UserMapper::toDomain($entity);

        $this->assertNotEmpty($user->getId());
        $this->assertEquals('test@example.com', $user->getEmail());
        $this->assertNotEmpty($user->getPassword());
    }

    public function testToEntity(): void
    {
        $user = new User(
            Uuid::v7(),
            'test@example.com',
            'password'
        );

        $entity = UserMapper::toEntity($user);

        $this->assertNotEmpty($entity->id);
        $this->assertEquals('test@example.com', $entity->email);
        $this->assertEquals('password', $entity->password);
    }
}
