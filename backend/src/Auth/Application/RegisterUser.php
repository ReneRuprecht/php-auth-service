<?php

namespace App\Auth\Application;

use App\Auth\Domain\User;
use Symfony\Component\Uid\Uuid;

class RegisterUser
{
    public function __construct(private UserRepositoryPort $repo)
    {
    }

    public function execute(RegisterUserDto $dto): void
    {
        $user = new User(
            Uuid::v7(),
            $dto->getEmail(),
            password_hash($dto->getPassword(), PASSWORD_BCRYPT)
        );

        $this->repo->save($user);
    }
}
