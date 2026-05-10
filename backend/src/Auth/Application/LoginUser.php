<?php

namespace App\Auth\Application;

use App\Auth\Domain\Exception\InvalidCredentialsException;
use App\Auth\Domain\UserEmail;

class LoginUser
{
    public function __construct(private UserRepositoryPort $repo, private PasswordHasherPort $hasher)
    {
    }

    /**
     * @throws InvalidCredentialsException
     */
    public function execute(LoginUserDto $dto): LoginResultDto
    {
        $email = UserEmail::fromString($dto->email);

        $user = $this->repo->findByEmail($email);

        if (!$user) {
            throw new InvalidCredentialsException();
        }

        if (!$this->hasher->verify($dto->password, $user->getPassword())) {
            throw new InvalidCredentialsException();
        }

        return new LoginResultDto($user->getUserID(), $user->getEmail());
    }
}
