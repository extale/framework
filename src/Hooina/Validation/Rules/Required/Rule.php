<?php

namespace Hooina\Validation\Rules\Required;

use Hooina\Interfaces\Validation\Rules\RuleInterface;
use Hooina\Validation\Rules\AbstractRule;

class Rule extends AbstractRule implements RuleInterface
{
    /**
     * Check value is valid.
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value): bool
    {
        return true;
    }
}
