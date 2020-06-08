<?php

namespace Hooina\Core\Exceptions;

use Exception;
use Throwable;

class ImplementationException extends Exception
{
    public function __construct(string $class, string $implementation, $code = 501, Throwable $previous = null)
    {
        $className = class_name($class);
        $implementationName = class_name($implementation);

        parent::__construct("$implementationName not implemented in $className", $code, $previous);
    }
}
