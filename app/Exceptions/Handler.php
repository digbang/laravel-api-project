<?php

namespace App\Exceptions;

use App\Domain\Enums\ErrorCode;
use App\Domain\Exceptions\DomainException;
use App\Http\Resources\ErrorResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (AuthenticationException $e) {
            return $this->respond($e, ErrorCode::AUTHENTICATION_EXCEPTION, Response::HTTP_UNAUTHORIZED);
        });

        $this->renderable(function (DomainException $e) {
            return $this->respond($e, $e->getErrorCode(), $e->getCode());
        });

        $this->renderable(function (HttpExceptionInterface $e) {
            return $this->respond($e, ErrorCode::HTTP_EXCEPTION, $e->getStatusCode());
        });

        $this->renderable(function (ValidationException $e) {
            return $this->respond($e, ErrorCode::VALIDATION_EXCEPTION, $e->status, additional: [
                'errors' => $e->errors(),
            ]);
        });

        $this->renderable(function (\Throwable $e) {
            return $this->respond($e);
        });
    }

    /**
     * Register a renderable callback.
     *
     * @param callable $renderUsing
     * @return $this
     */
    public function renderable(callable $renderUsing)
    {
        if (request()->is('api/*')) {
            return parent::renderable($renderUsing);
        }

        return $this;
    }

    private function respond(
        \Throwable $e,
        ErrorCode $error = ErrorCode::GENERIC_ERROR,
        int $status = Response::HTTP_INTERNAL_SERVER_ERROR,
        array $additional = [],
    ): JsonResponse {
        $resource = ErrorResource::make($error, $e->getMessage());

        $resource->additional($additional);

        $this->addStackTrace($resource, $e);

        return $resource->response()
            ->setStatusCode($status)
            ->withException($e);
    }

    private function addStackTrace(JsonResource $resource, \Throwable $e): void
    {
        if (app()->hasDebugModeEnabled()) {
            $additional = collect($resource->additional)->merge([
                'meta' => [
                    'exception' => get_class($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTrace(),
                ],
            ])->toArray();

            $resource->additional($additional);
        }
    }
}
