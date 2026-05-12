<?php

namespace App\Auth\Infrastructure\Security;

use App\Auth\Application\Dto\AuthValidationResult;
use App\Auth\Application\Port\TokenServicePort;
use App\Auth\Domain\User;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class JwtTokenService implements TokenServicePort
{
    public function __construct(private JWTTokenManagerInterface $jwtManager)
    {
    }

    public function create(User $user): string
    {
        $jwtUser = new JwtUser(
            $user->getUserID()->value(),
            $user->getEmail()->value(),
            ['ROLE_USER']
        );

        return $this->jwtManager->createFromPayload($jwtUser, [
            'sub' => $user->getUserID()->value(),
            'email' => $user->getEmail()->value(),
        ]);
    }

    public function validate(string $token): AuthValidationResult
    {
        try {
            $payload = $this->jwtManager->parse($token);

            if (!isset($payload['sub'], $payload['email'])) {
                return AuthValidationResult::invalid();
            }

            return AuthValidationResult::valid($payload['sub'], $payload['email']);
        } catch (JWTDecodeFailureException) {
            return AuthValidationResult::invalid();
        }
    }
}
