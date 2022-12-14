<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */


interface EloquentRepositoryInterface
{
    public function allWithPagination();

    public function all(): Collection;
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    public function delete(Model $model);

    public function update(Model $model,$data): bool;


}
