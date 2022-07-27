<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Domain\Repositories\Contracts\UserRepository;

class ShowUserController extends Controller
{
    public function __invoke(int $id, UserRepository $users)
    {
        return UserResource::make($users->get($id));
    }
}
