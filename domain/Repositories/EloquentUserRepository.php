<?php

namespace Domain\Repositories;

use Domain\Exceptions\ModelNotFoundException;
use Domain\Models\User;
use Domain\Repositories\Contracts\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class EloquentUserRepository extends BaseRepository implements UserRepository
{
    /**
     * {@inheritDoc}
     */
    public function all(): Collection
    {
        return $this->query()->get();
    }

    /**
     * {@inheritDoc}
     */
    public function get(int $id): User
    {
        $onNotFound = fn () => throw new ModelNotFoundException("User {$id} not found");

        return $this->query()->findOr($id, callback: $onNotFound);
    }

    /**
     * {@inheritDoc}
     */
    protected function query(): Builder
    {
        return User::query();
    }
}
