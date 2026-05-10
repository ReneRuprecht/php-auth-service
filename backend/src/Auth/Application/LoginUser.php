<?php

namespace App\Auth\Application;

use App\Auth\Domain\Exception\InvalidCredentialsException;
use App\Auth\Domain\UserEmail;

class LoginUser
{
    public function __construct(private UserRepositoryPort $repo, private PasswordHasherPort $hasher, private TokenServicePort $tokenService)
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

        $token = $this->tokenService->create($user);

        return new LoginResultDto($token);
    }
}
