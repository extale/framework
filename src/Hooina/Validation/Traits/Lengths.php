<?php

namespace Hooina\Validation\Traits;

trait Lengths
{
    /**
     * Return count or length of value
     *
     * @param $value
     *
     * @return int
     */
    public function getLength($value): int
    {
        $length = 0;

        if (is_string($value)) {
            $length = strlen($value);
        }

        if (is_array($value)) {
            $length = count($value);
        }

        return $length;
    }
}
