<?php

namespace Hooina\Interfaces\Http\Requests\Files\Factory;

use Hooina\Interfaces\Core\Factory\FactoryInterface;
use Hooina\Interfaces\Http\Requests\Files\RequestFileInterface;

interface RequestFileFactoryInterface extends FactoryInterface
{
    public function create(string $name, string $type, string $temp, int $error, int $size): RequestFileInterface;
}
