<?php

namespace Hooina\Http\Validation;

use Hooina\Interfaces\Validation\Errors\ErrorBagInterface;
use Hooina\Interfaces\Validation\ValidatorInterface;

class FakeValidator implements ValidatorInterface
{
    /**
     * Start validation
     *
     * @param array $validationData Values that will by validated
     * @param array $validationRules Rule used for validate value
     * @return bool
     */
    public function make(array $validationData, array $validationRules): bool
    {
        return true;
    }

    /**
     * Get error bag with exists errors
     *
     * @return ErrorBagInterface
     */
    public function getErrors(): ?ErrorBagInterface
    {
        return null;
    }
}
