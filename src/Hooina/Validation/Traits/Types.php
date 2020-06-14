<?php

namespace Hooina\Validation\Traits;

use Hooina\Validation\Enums\TypesEnum;

trait Types
{
    /**
     * Return type of value
     *
     * @param $value
     *
     * @return string
     */
    public function getType($value): string
    {
        $types = new TypesEnum();

        return $types->getValue(gettype($value));
    }
}
