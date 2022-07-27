<?php

namespace Domain\Repositories\Contracts;

use Domain\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    public function all(): Collection;

    public function get(int $id): User;
}
