<?php

namespace Hooina\Interfaces\Validation\Errors;

interface ErrorBagInterface
{
    public function all(): array;

    public function get(string $name): array;

    public function first();
}
