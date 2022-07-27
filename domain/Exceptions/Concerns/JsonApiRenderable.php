<?php

namespace Domain\Exceptions\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait JsonApiRenderable
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => [
                'code' => $this->getCode(),
                'message' => $this->getMessage(),
            ],
        ], $this->getCode());
    }
}
