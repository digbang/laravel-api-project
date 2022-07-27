<?php

use App\Http\Controllers\Users\CreateUserController;
use App\Http\Controllers\Users\ListUsersController;
use App\Http\Controllers\Users\ShowUserController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function (Router $router) {
    // Get all users
    $router->get('/', ListUsersController::class);

    // Get an user by ID
    $router->get('/{id}', ShowUserController::class);

    // Create a user
    $router->post('/', CreateUserController::class);
});

Route::fallback(fn () => response()->json(['message' => '404 Not Found'], 404));
