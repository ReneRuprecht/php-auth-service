<?php

namespace App\Auth\Domain\Exception;

class InvalidCredentialsException extends AuthenticationException
{
    public function __construct()
    {
        parent::__construct('Invalid credentials');
    }
}
