<?php

namespace Hooina\Validation\Rules\Phone;

use Hooina\Interfaces\Validation\Rules\RuleInterface;
use Hooina\Validation\Rules\AbstractRule;

class Rule extends AbstractRule implements RuleInterface
{
    /**
     * Default error message.
     *
     * @var string $errorMessage
     */
    protected string $errorMessage = 'has wrong format.';

    /**
     * Check value is valid.
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value): bool
    {
        $replacePattern = '/(\-|\s|\+)/i';

        $pattern = '/^\d+$/i';

        $phone = preg_replace($replacePattern, '', trim($value));

        return (strlen($phone) == 10) && (preg_match($pattern, $phone));
    }
}
