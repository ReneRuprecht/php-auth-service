<?php

namespace App\Auth\Infrastructure\Doctrine;

use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserID;
use App\Auth\Domain\UserPassword;

class UserMapper
{
    public static function toEntity(User $user): UserEntity
    {
        $entity = new UserEntity();
        $entity->id = $user->getUserID()->value();
        $entity->email = $user->getEmail()->value();
        $entity->password = $user->getPassword()->value();

        return $entity;
    }

    public static function toDomain(UserEntity $entity): User
    {
        $id = UserID::fromString($entity->id);
        $email = UserEmail::fromString($entity->email);
        $password = UserPassword::fromHash($entity->password);

        return new User($id, $email, $password);
    }
}
