<?php

namespace App\Repositories;

use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;

class FeatureRepository extends BaseRepository implements FeatureRepositoryInterface
{
    public function __construct(Feature $feature)
    {
        $this->model = $feature;
    }

    public function create(array $data) : Model
    {
        $data['user_id'] = auth()->id();

        return $this->model->create($data);
    }
}
