<?php

namespace Hooina\Http\Requests;

use Hooina\Http\Requests\Files\RequestFile;
use Hooina\Interfaces\Http\Requests\RequestInterface;
use Hooina\Interfaces\Validation\ValidatorInterface;

class Request implements RequestInterface
{
    /**
     * Requested path
     *
     * @var string $path
     */
    protected string $path;

    /**
     * Request method type
     *
     * @var string $method
     */
    protected string $method;

    /**
     * Headers
     *
     * @var array $headers
     */
    protected array $headers;

    /**
     * Files
     *
     * @var array $files
     */
    protected array $files;

    /**
     * Parameters
     *
     * @var array $parameters
     */
    protected array $parameters = [];

    /**
     * Validation rules
     *
     * @var array $rules
     */
    protected array $rules = [];

    /**
     * Validation errors
     *
     * @var array $errors
     */
    protected array $errors = [];

    /**
     * Validate current request using rules
     *
     * @param ValidatorInterface $validator
     *
     * @return bool
     *
     */
    public function validate(ValidatorInterface $validator): bool
    {
        $isValid = $validator->make($this->parameters, $this->rules);
        if ($isValid === false) {
            $this->errors = $validator->getErrors()->all();

            return false;
        }

        return true;
    }

    /**
     * Get request parameter by key
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->parameters[$key];
    }

    /**
     * Request path getter
     *
     * @return string
     */
    public function getRequestPath(): string
    {
        return $this->path;
    }

    /**
     * Errors getter
     *
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * Request method getter
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     *Parameters getter
     *
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Files getter
     *
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Get file by name
     *
     * @param string $name
     * @return RequestFile|null
     */
    public function getFile(string $name): ?RequestFile
    {
        return $this->files[$name];
    }

    /**
     * Headers getter
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
