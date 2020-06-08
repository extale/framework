<?php

namespace Hooina\Http\Requests\Contracts;

interface RequestContract
{
    public function all(): array;

    public function get(string $key): ?string;

    public function getMethod(): string;

    public function getRequestPath(): string;
}
