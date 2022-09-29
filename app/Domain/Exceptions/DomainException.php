<?php

namespace App\Domain\Exceptions;

use App\Domain\Enums\ErrorCode;

abstract class DomainException extends \RuntimeException
{
    public function __construct(string $message = null)
    {
        parent::__construct($message ?: $this->getErrorCode()->translate(), $this->getStatusCode());
    }

    public function getStatusCode(): int
    {
        return 500;
    }

    abstract public function getErrorCode(): ErrorCode;
}
