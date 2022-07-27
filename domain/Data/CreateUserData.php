<?php

namespace Domain\Data;

use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
    public function __construct(
        public readonly string $name,
        #[Email]
        public readonly string $email,
        #[Password(min: 8), Confirmed]
        public readonly string $password,
        #[Password(min: 8)]
        public readonly string $password_confirmation,
    ) {
        //
    }
}
