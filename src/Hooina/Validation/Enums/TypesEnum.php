<?php

namespace Hooina\Validation\Enums;

use Hooina\Enums\AbstractEnum;

class TypesEnum extends AbstractEnum
{
    protected static function getEnum(): array
    {
        return [
            'string' => 'characters',
            'array' => 'arrays'
        ];
    }
}
