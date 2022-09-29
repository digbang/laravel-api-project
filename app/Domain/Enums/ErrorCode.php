<?php

namespace App\Domain\Enums;

enum ErrorCode: string
{
    case AUTHENTICATION_EXCEPTION = 'UNAUTHENTICATED';
    case GENERIC_ERROR = 'GENERIC_ERROR';
    case HTTP_EXCEPTION = 'HTTP_EXCEPTION';
    case VALIDATION_EXCEPTION = 'VALIDATIONE_EXCEPTION';

    public function translate(): string
    {
        return __(sprintf('error.%s', $this->value));
    }
}
