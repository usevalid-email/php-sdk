<?php

namespace UseValidEmail\Sdk\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    public function __construct()
    {
        parent::__construct('Forbidden', 403);
    }
}
