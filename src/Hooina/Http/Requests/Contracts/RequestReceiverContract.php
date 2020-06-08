<?php

namespace Hooina\Http\Requests\Contracts;

use Hooina\Http\Requests\Request;

interface RequestReceiverContract
{
    public function getRequest(): Request;
}
