<?php

namespace App\Exceptions;

use Exception;

class MissingOrInvalidApiToken extends Exception
{
    public function __construct()
    {
        parent::__construct('A valid API token is missing', 403);
    }
}
