<?php

namespace Hooina\Validation\Rules\Phone\CountryCode;

use Hooina\Validation\Rules\AbstractRule;
use Hooina\Enums\Base\CountryPhoneCodes;

class Rule extends AbstractRule
{
    /**
     * Default error message
     *
     * @var string $errorMessage
     */
    protected string $errorMessage = 'is invalid.';

    /**
     * Check value is valid
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value): bool
    {
        return CountryPhoneCodes::isKeyExist($value);
    }
}
