<?php

namespace App\Tests\Auth\Infrastructure\Doctrine;

use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserID;
use App\Auth\Domain\UserPassword;
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

        $this->assertNotEmpty($user->getUserID()->value());
        $this->assertEquals('test@example.com', $user->getEmail()->value());
        $this->assertNotEmpty($user->getPassword()->value());
    }

    public function testToEntity(): void
    {
        $uid = UserID::newUserID();
        $email = UserEmail::fromString('test@example.com');
        $password = UserPassword::fromHash('password');
        $user = new User($uid, $email, $password);

        $entity = UserMapper::toEntity($user);

        $this->assertNotEmpty($entity->id);
        $this->assertEquals('test@example.com', $entity->email);
        $this->assertEquals('password', $entity->password);
    }
}
