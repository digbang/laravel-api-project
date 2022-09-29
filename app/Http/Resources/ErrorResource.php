<?php

namespace App\Http\Resources;

use App\Domain\Enums\ErrorCode;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'error';

    public function __construct(ErrorCode $error = ErrorCode::GENERIC_ERROR, string $message = null)
    {
        parent::__construct(compact('error', 'message'));
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var ErrorCode $error */
        $error = $this->resource['error'];
        $message = $this->resource['message'] ?: null;

        return [
            'code' => $error->value,
            'message' => $message ?: $error->translate(),
        ];
    }
}
