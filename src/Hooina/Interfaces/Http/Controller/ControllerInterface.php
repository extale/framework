<?php

namespace Hooina\Interfaces\Http\Controller;

use Hooina\Interfaces\Http\Requests\RequestInterface;
use Hooina\Interfaces\Http\Responses\ResponseInterface;

interface ControllerInterface
{
    public function run(RequestInterface $request = null): ResponseInterface;

    public function getActionRequest(): ?string;
}
