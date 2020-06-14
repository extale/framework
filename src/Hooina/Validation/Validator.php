<?php

namespace Hooina\Validation;

use Hooina\Interfaces\Validation\Errors\ErrorBagInterface;
use Hooina\Validation\Errors\ErrorBag;
use Hooina\Validation\Exceptions\RuleNotFoundException;
use Hooina\Interfaces\Validation\ValidatorInterface;
use Hooina\Validation\Rules\Factory\RuleFactory;
use Hooina\Interfaces\Validation\Rules\RuleInterface;

class Validator implements ValidatorInterface
{
    /**
     * Array of validation errors.
     *
     * @var array $errors
     */
    protected array $errors;

    /**
     * Validation result. Default is true.
     *
     * @var bool $success
     */
    protected bool $success = true;

    /**
     * Array of validation rules.
     *
     * @var array
     */
    protected array $rules;

    /**
     * Start validation.
     *
     * @param array $validationData Values that will by validated
     * @param array $validationRules Rule used for validate value
     *
     * @return bool
     *
     * @throws RuleNotFoundException
     */
    public function make(array $validationData, array $validationRules): bool
    {
        foreach ($validationRules as $name => $rules) {
            $rulesList = $this->getRules($rules);

            if (isset($validationData[$name]) === false) {
                if (in_array('required', $rulesList)) {
                    $this->addError($name, "$name is required");
                }

                continue;
            }

            $this->validateValue($name, $validationData[$name], $rulesList);
        }

        return $this->success;
    }

    /**
     * Get error bag with exists errors.
     *
     * @return ErrorBagInterface
     */
    public function getErrors(): ErrorBagInterface
    {
        return new ErrorBag($this->errors);
    }

    /**
     * Validate value uses rules array.
     *
     * @param string $field
     * @param $value
     * @param array $rules
     *
     * @throws RuleNotFoundException
     */
    protected function validateValue(string $field, $value, array $rules)
    {
        foreach ($rules as $rule) {
            $ruleValidator = $this->createRuleValidator($rule);

            $isValid = $ruleValidator->isValid($value);
            if ($isValid === false) {
                $this->addError($field, $ruleValidator->getError());
            }
        }
    }

    /**
     * Get rules list for validate a value.
     *
     * @param string $rulesString
     *
     * @return false|string[]
     */
    protected function getRules(string $rulesString)
    {
        $preparedRulesString = preg_replace('/\s+/', '', $rulesString);

        $rulesArray = explode(',', $preparedRulesString);

        $requiredIndex = array_search('required', $rulesArray);
        if ($requiredIndex === false) {
            return $rulesArray;
        }

        if ($requiredIndex === 0) {
            return $rulesArray;
        }

        $replaceValue = $rulesArray[0];

        $rulesArray[0] = 'required';
        $rulesArray[$requiredIndex] = $replaceValue;

        return $rulesArray;
    }

    /**
     * Add an error to error bag.
     *
     * @param string $name Name of validated field
     * @param string $error Validation error details
     */
    protected function addError(string $name, string $error): void
    {
        if ($this->success !== false) {
            $this->success = false;
        }

        $this->errors[$name][] = $error;
    }

    /**
     * Create rule validator.
     *
     * @param string $rule Name of rule with options like min:15
     *
     * @return RuleInterface
     *
     * @throws RuleNotFoundException
     */
    protected function createRuleValidator(string $rule): RuleInterface
    {
        $explodedRule = explode(':', $rule);

        $name = $explodedRule[0];
        $options = $explodedRule[1] ?? null;

        if (class_exists($this->rules[$name]) === false) {
            throw new RuleNotFoundException("Rule $name has not realisation");
        }

        return (new RuleFactory())->create($this->rules[$name], $name, $options);
    }
}
