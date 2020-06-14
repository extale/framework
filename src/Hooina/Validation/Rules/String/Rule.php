<?php

namespace Hooina\Validation\Rules\String;

use Hooina\Interfaces\Validation\Rules\RuleInterface;
use Hooina\Validation\Rules\AbstractRule;

class Rule extends AbstractRule implements RuleInterface
{
    protected string $errorMessage = 'is not a string';

    /**
     * Check value is valid
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value): bool
    {
        return is_string($value);
    }
}
