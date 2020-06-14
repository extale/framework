<?php

namespace Hooina\Http\Requests;

use Hooina\Http\Requests\Factory\RequestFactory;
use Hooina\Interfaces\Http\Requests\RequestReceiverInterface;
use Hooina\Http\Requests\Traits\Globals;

class RequestReceiver implements RequestReceiverInterface
{
    use Globals;

    /**
     * Receive request and create using factory
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return (new RequestFactory(Request::class))->create($this->getRequestData());
    }
}
