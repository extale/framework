<?php

namespace Hooina\Validation\Exceptions;

use Throwable;
use Exception;

class RuleNotFoundException extends Exception
{
    public function __construct(string $rule, Throwable $previous = null)
    {
        parent::__construct("Rule $rule not found.", 501, $previous);
    }
}
