<?php

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::get('/', function (Config $config) {
    return JsonResource::make([
        'name' => $config->get('app.name'),
        'version' => $config->get('app.version', '0.1.0'),
    ]);
});

Route::fallback(function () {
    throw new NotFoundHttpException(Response::$statusTexts[Response::HTTP_NOT_FOUND]);
});
