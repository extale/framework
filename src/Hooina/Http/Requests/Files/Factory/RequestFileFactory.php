<?php

namespace Hooina\Http\Requests\Files\Factory;

use Hooina\Http\Requests\Files\RequestFile;
use Hooina\Interfaces\Http\Requests\Files\Factory\RequestFileFactoryInterface;

class RequestFileFactory extends RequestFile implements RequestFileFactoryInterface
{
    public function create(string $name, string $type, string $temp, int $error, int $size): RequestFile
    {
        $file = new RequestFile();

        $file->name = $name;
        $file->type = $type;
        $file->temp = $temp;
        $file->size = $size;
        $file->error = $error;

        return $file;
    }
}
