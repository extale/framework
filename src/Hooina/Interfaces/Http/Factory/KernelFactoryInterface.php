<?php

namespace Hooina\Interfaces\Http\Factory;

use Hooina\Interfaces\Core\Factory\FactoryInterface;
use Hooina\Interfaces\Http\KernelInterface;

interface KernelFactoryInterface extends FactoryInterface
{
    public function create(array $options = []): KernelInterface;
}
