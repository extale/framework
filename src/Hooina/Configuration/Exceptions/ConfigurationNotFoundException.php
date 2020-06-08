<?php

namespace Hooina\Configuration\Exceptions;

use Exception;
use Throwable;

class ConfigurationNotFoundException extends Exception
{
    public function __construct($name, $code = 523, Throwable $previous = null)
    {
        parent::__construct("Configuration $name not found", $code, $previous);
    }
}
