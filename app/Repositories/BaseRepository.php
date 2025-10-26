<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll($relations = null, $filters = null, $perPage = null)
    {
        $query = $this->model->query();

        if ($relations) {
            $query->with($relations);
        }

        return $query->latest('id')->paginate($perPage ?: 10);
    }

    public function getById($id) : ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data) : Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data) : bool
    {
        return  $model->update($data);
    }

    public function delete(Model $model) : bool
    {
        return $this->model->delete();
    }
}