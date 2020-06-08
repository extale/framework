<?php

namespace Hooina\Configuration\Exceptions;

use Exception;
use Throwable;

class WrongConfigFormatException extends Exception
{
    public function __construct(string $type, $code = 500, Throwable $previous = null)
    {
        parent::__construct("Configuration must by an array, not $type", $code, $previous);
    }
}
