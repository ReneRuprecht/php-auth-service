<?php

namespace App\Auth\Domain\Exception;

class InvalidPasswordException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Password cannot be empty');
    }
}
