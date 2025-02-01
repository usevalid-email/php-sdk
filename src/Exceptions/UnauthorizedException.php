<?php

namespace UseValidEmail\Sdk\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Unauthorized', 401);
    }
}
