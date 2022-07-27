<?php

namespace Domain\Actions;

use Domain\Data\CreateUserData;
use Domain\Models\User;

class CreateUser
{
    public function __invoke(CreateUserData $userData): User
    {
        $validUserData = CreateUserData::validate($userData);

        return User::create([
            'name' => $validUserData['name'],
            'email' => $validUserData['email'],
            'password' => bcrypt($validUserData['password']),
        ]);
    }
}
