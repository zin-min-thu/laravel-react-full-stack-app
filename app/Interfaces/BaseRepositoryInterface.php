<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getAll();
    public function getById($id) : ?Model;
    public function create(array $data) : Model;
    public function update(Model $model, array $data) : bool;
    public function delete(Model $model) : bool;
}