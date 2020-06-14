<?php

namespace Hooina\Validation\Rules\Factory;

use Hooina\Interfaces\Validation\Rules\Factory\RuleFactoryInterface;
use Hooina\Interfaces\Validation\Rules\RuleInterface;

class RuleFactory implements RuleFactoryInterface
{
    public function create(string $ruleClass, string $name, ?string $options = null): RuleInterface
    {
        $rule = new $ruleClass();

        $rule->setName($name);
        $rule->setOptions($options);

        return $rule;
    }
}
