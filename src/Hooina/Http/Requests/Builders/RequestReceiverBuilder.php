<?php

namespace Hooina\Http\Requests\Builders;

use Hooina\Http\Requests\Builders\Contracts\RequestReceiverBuilderContract;
use Hooina\Http\Requests\RequestReceiver;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class RequestReceiverBuilder extends RequestReceiver implements RequestReceiverBuilderContract
{
    protected RequestReceiver $requestReceiver;

    public function __construct(string $basePath)
    {
        $this->requestReceiver = new RequestReceiver();

        $this->requestReceiver->basePath = $basePath;

        return $this;
    }

    protected function getContent(SymfonyRequest $request): array
    {
        $params = [];

        $queryParams = $request->query->all();
        if (empty($queryParams) === false) {
            return $this->fillParams($queryParams, $params);
        }

        $requestParams = $request->request->all();
        if (empty($requestParams) === false) {
            return $this->fillParams($requestParams, $params);
        }

        $rawParams = json_decode($request->getContent(), true);
        if (empty($rawParams) === false) {
            return $this->fillParams($rawParams, $params);
        }

        return $params;
    }

    protected function fillParams(array $source, array $params): array
    {
        foreach ($source as $key => $value) {
            $params[$key] = $value;
        }

        return $params;
    }

    public function produce(): RequestReceiver
    {
        $request = $this->requestReceiver->request = SymfonyRequest::createFromGlobals();

        $this->requestReceiver->parameters = $this->getContent($request);

        return $this->requestReceiver;
    }
}
