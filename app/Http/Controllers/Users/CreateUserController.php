<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Domain\Actions\CreateUser;
use Domain\Data\CreateUserData;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function __invoke(Request $request, CreateUser $createUser)
    {
        $aNewUser = $createUser(CreateUserData::from($request->only([
            'name',
            'email',
            'password',
            'password_confirmation',
        ])));

        return UserResource::make($aNewUser);
    }
}
