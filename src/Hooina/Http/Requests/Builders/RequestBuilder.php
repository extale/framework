<?php

namespace Hooina\Http\Requests\Builders;

use Hooina\Http\Requests\Builders\Contracts\RequestBuilderContract;
use Hooina\Http\Requests\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class RequestBuilder extends Request implements RequestBuilderContract
{
    protected Request $request;

    public function __construct(SymfonyRequest $request, array $parameters = [])
    {
        $this->request = new Request();

        $this->request->parameters = $parameters;
        $this->request->method = $request->getMethod();
        $this->request->path = $request->getPathInfo();
        $this->request->headers = $request->headers->all();

        return $this;
    }

    public function produce(): Request
    {
        return $this->request;
    }
}
