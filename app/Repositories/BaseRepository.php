<?php

namespace App\Repositories;


use App\Models\Role;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function firstOrCreate(array $attributes): Model
    {
        return $this->model->firstOrCreate($attributes);
    }
    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->query()->orderBy('id', 'DESC')->get();
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

    public function allWithPagination()
    {
        return $this->model->query()->orderBy('id', 'DESC')->paginate('20');
    }
    public function update(Model $model, $data): bool
    {
       return $model->update($data);
    }

    public function findRoleByTitle($title){
        return Role::query()->where('title', $title)->firstOrFail();
    }
}
