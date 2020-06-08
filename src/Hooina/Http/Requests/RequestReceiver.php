<?php

namespace Hooina\Http\Requests;

use Hooina\Http\Requests\Builders\RequestBuilder;
use Hooina\Http\Requests\Contracts\RequestReceiverContract;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class RequestReceiver implements RequestReceiverContract
{
    protected SymfonyRequest $request;

    protected array $parameters;

    protected string $basePath;

    public function getRequest(): Request
    {
        return (new RequestBuilder($this->request, $this->parameters))->produce();
    }
}
