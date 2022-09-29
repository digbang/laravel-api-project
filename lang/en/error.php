<?php

use App\Domain\Enums\ErrorCode;
use Symfony\Component\HttpFoundation\Response;

return [
    ErrorCode::AUTHENTICATION_EXCEPTION->value => 'Unauthenticated',
    ErrorCode::GENERIC_ERROR->value => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR],
];
