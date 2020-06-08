<?php

namespace Hooina\Http\Builders\Contracts;

use Hooina\Http\Contracts\KernelContract;

interface KernelBuilderContract
{
    public function produce(): KernelContract;
}
