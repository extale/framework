<?php

namespace Hooina\Core\Exceptions;

use Throwable;

class Handler
{
    protected Throwable $exception;

    /**
     * @throws Throwable
     */
    public function __destruct()
    {
        $this->report();
    }

    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @throws Throwable
     */
    protected function report()
    {
        $this->throw();
    }

    /**
     * @throws Throwable
     */
    protected function throw(): void
    {
        throw $this->exception;
    }
}
