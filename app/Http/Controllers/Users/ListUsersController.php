<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Domain\Repositories\Contracts\UserRepository;

class ListUsersController extends Controller
{
    public function __invoke(UserRepository $users)
    {
        return UserResource::collection($users->all());
    }
}
