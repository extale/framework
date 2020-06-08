<?php

namespace Hooina\Core\Builders\Exceptions;

use Throwable;
use Exception;

class BuilderNotFoundException extends Exception
{
    public function __construct(string $name, int $code = 500, Throwable $previous = null)
    {
        parent::__construct("Builder with name $name is not registered", $code, $previous);
    }
}
