<?php

namespace Hooina\Interfaces\Http\Requests\Files;

interface RequestFileInterface
{
    public function getName();

    public function getKey();

    public function getType();

    public function getError();

    public function getTemp();

    public function getSize();
}
