<?php

namespace Hooina\Http\Requests\Builders\Contracts;

use Hooina\Http\Requests\RequestReceiver;

interface RequestReceiverBuilderContract
{
    public function produce(): RequestReceiver;
}
