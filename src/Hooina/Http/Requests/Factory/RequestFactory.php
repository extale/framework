<?php

namespace Hooina\Http\Requests\Factory;

use Hooina\Http\Requests\Request;

class RequestFactory extends Request
{
    protected string $requestClass;

    public function __construct($requestClass)
    {
        $this->requestClass = $requestClass;
    }

    public function create(array $data): Request
    {
        $request = new $this->requestClass();

        $request->method = $data['method'];
        $request->path = $data['path'];
        $request->parameters = $data['parameters'];
        $request->headers = $data['headers'];
        $request->files = $data['files'];

        return $request;
    }
}
