<?php

namespace App\Auth\Domain\Exception;

class InvalidEmailException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Email cannot be empty');
    }
}
