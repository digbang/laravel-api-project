<?php

namespace App\Console\Commands;

use Domain\Actions\CreateUser;
use Domain\Data\CreateUserData;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CreateUser $createUser)
    {
        $createUser(CreateUserData::from([
            'name' => $this->ask('Name'),
            'email' => $this->ask('Email'),
            'password' => $this->secret('Password'),
            'password_confirmation' => $this->secret('Confirm password'),
        ]));

        $this->info('User created!');

        return 0;
    }
}
