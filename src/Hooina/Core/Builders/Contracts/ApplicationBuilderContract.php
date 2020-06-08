<?php

namespace Hooina\Core\Builders\Contracts;

use Hooina\Core\Application;

interface ApplicationBuilderContract
{
    public function produce(): Application;
}
