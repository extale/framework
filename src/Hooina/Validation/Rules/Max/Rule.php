<?php

namespace Hooina\Validation\Rules\Max;

use Hooina\Interfaces\Validation\Rules\RuleInterface;
use Hooina\Validation\Rules\AbstractRule;
use Hooina\Validation\Traits\Lengths;
use Hooina\Validation\Traits\Types;

class Rule extends AbstractRule implements RuleInterface
{
    use Lengths;
    use Types;

    /**
     * Value type.
     *
     * @var string $type
     */
    protected string $type;

    /**
     * Check value is valid.
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value): bool
    {
        $length = $this->getLength($value);

        $this->type = $this->getType($value);

        return $length <= (int) $this->options;
    }

    /**
     * Error getter.
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->errorMessage = "is longest than $this->options $this->type.";
    }
}
