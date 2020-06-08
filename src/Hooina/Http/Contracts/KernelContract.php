<?php

namespace Hooina\Http\Contracts;

use Hooina\Http\Responses\Contracts\ResponseContract;

interface KernelContract
{
    public function handle(): ResponseContract;
}
