<?php

namespace Hooina\Validation\Factory\Interfaces;

use Hooina\Interfaces\Validation\ValidatorInterface;

interface ValidatorFactoryInterface
{
    public function create(array $rules): ValidatorInterface;
}
