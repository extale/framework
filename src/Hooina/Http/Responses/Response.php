<?php

namespace Hooina\Http\Responses;

use Hooina\Interfaces\Http\Responses\ResponseInterface;

class Response implements ResponseInterface
{
    protected $content;

    protected int $statusCode;

    public function __construct($content, int $statusCode)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;

        header('Content-Type: application/json');
        http_response_code($statusCode);
    }

    public function send(): void
    {
        echo json_encode($this->content);
    }
}
