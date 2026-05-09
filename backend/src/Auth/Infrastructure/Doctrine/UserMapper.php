<?php

namespace App\Auth\Infrastructure\Doctrine;

use App\Auth\Domain\User;
use App\Auth\Infrastructure\Doctrine\UserEntity;
use Symfony\Component\Uid\Uuid;

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
    $id = Uuid::fromString($entity->id);
    return new User($id, $entity->email, $entity->password);
  }
}
