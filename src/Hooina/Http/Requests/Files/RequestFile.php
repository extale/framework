<?php

namespace Hooina\Http\Requests\Files;

use Hooina\Interfaces\Http\Requests\Files\RequestFileInterface;

class RequestFile implements RequestFileInterface
{
    /**
     * File original name
     *
     * @var string $name
     */
    protected string $name;

    /**
     * File identifier in array
     *
     * @var string
     */
    protected string $key;

    /**
     * File type
     *
     * @var string $type
     */
    protected string $type;

    /**
     * Path int temp folder
     *
     * @var string $temp
     */
    protected string $temp;

    /**
     * Error flag
     *
     * @var int $error
     */
    protected int $error;

    /**
     * File size
     *
     * @var int $size
     */
    protected int $size;

    /**
     * Name getter
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Key getter
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Type getter
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Error flag getter
     *
     * @return int
     */
    public function getError(): int
    {
        return $this->error;
    }

    /**
     * Temporary path getter
     *
     * @return string
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * File size getter
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}
