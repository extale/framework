<?php

namespace Hooina\Validation\Errors;

use Hooina\Interfaces\Validation\Errors\ErrorBagInterface;

class ErrorBag implements ErrorBagInterface
{
    /**
     * Array of validation errors
     *
     * @var array $errors
     */
    protected array $errors;

    /**
     * ErrorBag constructor.
     *
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Get all errors from bag
     *
     * @return array
     */
    public function all(): array
    {
        return $this->errors;
    }

    /**
     * Get error by name
     *
     * @param string $name
     *
     * @return array
     */
    public function get(string $name): array
    {
        return $this->errors[$name] ?? [];
    }

    /**
     * Get first error
     *
     * @return string
     */
    public function first()
    {
        $firstError = array_values($this->errors)[0];

        return array_keys($firstError)[0] . ' ' . array_values($firstError)[0];
    }
}
