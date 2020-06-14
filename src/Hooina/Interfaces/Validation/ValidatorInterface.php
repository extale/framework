<?php

namespace Hooina\Interfaces\Validation;

use Hooina\Interfaces\Validation\Errors\ErrorBagInterface;

interface ValidatorInterface
{
    public function make(array $validationData, array $validationRules): bool;

    public function getErrors(): ?ErrorBagInterface;
}