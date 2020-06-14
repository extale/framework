<?php

namespace Hooina\Interfaces\Validation\Rules;

interface RuleInterface
{
    /**
     * Check value is valid
     *
     * @param $value
     *
     * @return bool
     */
    public function isValid($value): bool;

    /**
     * Error getter
     *
     * @return string
     */
    public function getError(): string;

    public function setName(string $name): void;

    public function setOptions(string $options = null): void;
}
