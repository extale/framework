<?php

namespace Hooina\Validation\Factory;

use Hooina\Validation\Factory\Interfaces\ValidatorFactoryInterface;
use Hooina\Interfaces\Validation\ValidatorInterface;
use Hooina\Validation\Validator;

class ValidatorFactory extends Validator implements ValidatorFactoryInterface
{
    /**
     * Default available rules.
     *
     * @var array $rules
     */
    protected array $rules = [
        'required' => \Hooina\Validation\Rules\Required\Rule::class,
        'string' => \Hooina\Validation\Rules\String\Rule::class,
        'min' => \Hooina\Validation\Rules\Min\Rule::class,
        'max' => \Hooina\Validation\Rules\Max\Rule::class,
        'phone' => \Hooina\Validation\Rules\Phone\Rule::class,
        'phone_code' => \Hooina\Validation\Rules\Phone\CountryCode\Rule::class,
    ];

    /**
     * Create and initialize Validator.
     *
     * @param array $rules
     *
     * @return ValidatorInterface
     */
    public function create(array $rules = null): ValidatorInterface
    {
        $validator = new Validator();

        $validatorRules = $this->rules;

        if (is_null($rules) === false) {
            $validatorRules = array_merge($rules, $validatorRules);
        }

        $validator->rules = $validatorRules;

        return $validator;
    }
}
