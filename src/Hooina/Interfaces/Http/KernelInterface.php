<?php

namespace Hooina\Interfaces\Http;

use Hooina\Interfaces\Http\Responses\ResponseInterface;

interface KernelInterface
{
    public function handle(): ResponseInterface;
}
