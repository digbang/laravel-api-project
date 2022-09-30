<?php

namespace App\Domain\Exceptions;

use App\Domain\Enums\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

abstract class DomainException extends \DomainException
{
    protected ErrorCode $errorCode = ErrorCode::GENERIC_ERROR;

    protected int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    public function __construct(string $message = null)
    {
        parent::__construct($message ?: $this->errorCode->translate(), $this->statusCode);
    }

    public function getErrorCode(): ErrorCode
    {
        return $this->errorCode;
    }
}
