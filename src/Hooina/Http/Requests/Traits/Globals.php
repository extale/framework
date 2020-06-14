<?php

namespace Hooina\Http\Requests\Traits;

use Hooina\Http\Requests\Files\Factory\RequestFileFactory;

trait Globals
{
    protected function getPath(): string
    {
        return explode('?', $_SERVER['REQUEST_URI'], 2)[0];
    }

    protected function getFiles(): array
    {
        $files = [];

        if (is_countable($_FILES) === false) {
            return $files;
        }

        foreach ($_FILES as $key => $data) {
            $file = (new RequestFileFactory())->create(...array_values($data));

            $files[$key] = $file;
        }

        return $files;
    }

    protected function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function getParams(): array
    {
        $params = [];

        $queryParams = $_GET;
        if (empty($queryParams) === false) {
            $params = $queryParams;
        }

        $postParams = $_POST;
        if (empty($postParams) === false) {
            $params = $postParams;
        }

        $bodyParams = json_decode(file_get_contents("php://input"), true);
        if (empty($bodyParams) === false) {
            $params = $bodyParams;
        }

        return $params;
    }

    protected function getHeaders(): array
    {
        $headers = [];

        $defaultHeaders = [
            'content-type' => $_SERVER['CONTENT_TYPE'],
            'content-length' => $_SERVER['CONTENT_LENGTH'],
        ];

        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 4) === 'HTTP') {
                $headers[$this->formatHeader($name)] = $value;
            }
        }

        return array_merge($defaultHeaders, $headers);
    }

    public function getRequestData(): array
    {
        return [
            'method' => $this->getMethod(),
            'path' => $this->getPath(),
            'headers' => $this->getHeaders(),
            'parameters' => $this->getParams(),
            'files' => $this->getFiles()
        ];
    }

    protected function formatHeader(string $header): string
    {
        $raw = substr(strtolower($header), 5);

        return str_replace('_', '-', $raw);
    }
}
