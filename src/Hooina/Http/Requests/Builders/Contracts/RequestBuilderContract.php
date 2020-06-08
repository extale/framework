<?php

namespace Hooina\Http\Requests\Builders\Contracts;

use Hooina\Http\Requests\Request;

interface RequestBuilderContract
{
    public function produce(): Request;
}
