<?php

namespace App\Auth\Infrastructure\Security;

use App\Auth\Application\TokenServicePort;
use App\Auth\Domain\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class JwtTokenService implements TokenServicePort
{
    public function __construct(private JWTTokenManagerInterface $jwtManager)
    {
    }

    public function create(User $user): string
    {
        $jwtUser = new JwtUser(
            $user->getUserID(),
            $user->getEmail(),
            ['ROLE_USER']
        );

        return $this->jwtManager->create($jwtUser);
    }
}
