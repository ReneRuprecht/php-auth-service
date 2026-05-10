<?php

namespace App\Auth\Application;

use App\Auth\Domain\Exception\InvalidPasswordException;
use App\Auth\Domain\User;
use App\Auth\Domain\UserEmail;
use App\Auth\Domain\UserID;
use App\Auth\Domain\UserPassword;

class RegisterUser
{
    public function __construct(private UserRepositoryPort $repo, private PasswordHasherPort $hasher)
    {
    }

    /**
     * @throws InvalidPasswordException
     */
    public function execute(RegisterUserDto $dto): void
    {
        $id = UserID::newUserID();
        $email = UserEmail::fromString($dto->getEmail());
        $plain = $dto->getPassword();

        if ('' == trim($plain)) {
            throw new InvalidPasswordException('Password cannot be empty');
        }
        $hash = $this->hasher->hash($dto->getPassword());
        $password = UserPassword::fromHash($hash);

        $user = new User(
            $id,
            $email,
            $password
        );

        $this->repo->save($user);
    }
}
