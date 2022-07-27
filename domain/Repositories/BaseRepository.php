<?php

namespace Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    abstract protected function query(): Builder;
}
