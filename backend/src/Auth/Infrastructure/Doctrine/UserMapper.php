<?php

namespace App\Auth\Infrastructure\Doctrine;

use App\Auth\Domain\User;
use Symfony\Component\Uid\UuidV7;

class UserMapper
{
    public static function toEntity(User $user): UserEntity
    {
        $entity = new UserEntity();
        $entity->id = $user->getId();
        $entity->email = $user->getEmail();
        $entity->password = $user->getPassword();

        return $entity;
    }

    public static function toDomain(UserEntity $entity): User
    {
        $id = UuidV7::fromString($entity->id);

        return new User($id, $entity->email, $entity->password);
    }
}
