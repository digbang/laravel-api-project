<?php

namespace Domain\Exceptions;

use Domain\Exceptions\Concerns\JsonApiRenderable;
use Exception;

class ModelNotFoundException extends Exception
{
    use JsonApiRenderable;

    public function __construct(string $message)
    {
        parent::__construct($message, code: 404);
    }
}
