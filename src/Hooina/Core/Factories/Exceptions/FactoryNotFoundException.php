<?php

namespace Hooina\Core\Factories\Exceptions;

use Throwable;
use Exception;

class FactoryNotFoundException extends Exception
{
    public function __construct(string $name, int $code = 500, Throwable $previous = null)
    {
        parent::__construct("Factory with name $name is not registered", $code, $previous);
    }
}
