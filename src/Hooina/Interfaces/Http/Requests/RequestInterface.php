<?php

namespace Hooina\Interfaces\Http\Requests;

use Hooina\Interfaces\Http\Requests\Files\RequestFileInterface;
use Hooina\Interfaces\Validation\ValidatorInterface;

interface RequestInterface
{
    public function get(string $key);

    public function getRequestPath(): string;

    public function getMethod(): string;

    public function getErrors(): ?array;

    public function validate(ValidatorInterface $validator): bool;

    public function getParameters(): ?array;

    public function getFiles(): array;

    public function getFile(string $name): ?RequestFileInterface;

    public function getHeaders(): array;
}
