<?php

namespace Hooina\Validation\Rules;

use Hooina\Interfaces\Validation\Rules\RuleInterface;

abstract class AbstractRule implements RuleInterface
{
    /**
     * Name of rule.
     *
     * @var string $name
     */
    protected string $name;

    /**
     * Rule options.
     *
     * @var string|null
     */
    protected ?string $options;

    /**
     * Default error message.
     *
     * @var string $errorMessage
     */
    protected string $errorMessage = 'Unknown error';

    /**
     * AbstractRule constructor.
     *
     * @param string|null $options
     */
    public function __construct(?string $options = null)
    {
        $this->options = $options;
    }

    /**
     * Return an error message.
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->errorMessage;
    }

    /**
     * Name setter.
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Options setter.
     *
     * @param string|null $options
     */
    public function setOptions(string $options = null): void
    {
        $this->options = $options;
    }
}
