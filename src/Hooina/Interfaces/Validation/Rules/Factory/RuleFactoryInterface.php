<?php

namespace Hooina\Interfaces\Validation\Rules\Factory;

use Hooina\Interfaces\Validation\Rules\RuleInterface;

interface RuleFactoryInterface
{
    public function create(string $ruleClass, string $name, ?string $options = null): RuleInterface;
}
