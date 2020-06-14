<?php

namespace Hooina\Interfaces\Http\Requests;

interface RequestReceiverInterface
{
    public function getRequest(): RequestInterface;
}
