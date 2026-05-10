<?php

namespace App\Auth\Infrastructure\Doctrine;

use App\Auth\Application\UserRepositoryPort;
use App\Auth\Domain\User;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryPort
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function save(User $user): void
    {
        $entity = UserMapper::toEntity($user);
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function findByEmail(string $email): ?User
    {
        $entity = $this->em
          ->getRepository(UserEntity::class)
          ->findOneBy(['email' => $email]);

        if (!$entity) {
            return null;
        }

        $user = UserMapper::toDomain($entity);

        return $user;
    }
}
