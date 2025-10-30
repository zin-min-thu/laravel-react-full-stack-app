<?php

namespace App\Repositories;

use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FeatureRepository extends BaseRepository implements FeatureRepositoryInterface
{
    public $user_id;

    public function __construct(Feature $feature)
    {
        $this->model    = $feature;
        $this->user_id  = auth()->id();
    }

    public function getAll($relations = null, $filters = null, $perPage = null)
    {
        $query = $this->model->query();

        if ($relations) {
            $query->with($relations);
        }

        $query->withCount(['upvotes as upvote_count' => function ($query) {
                $query->select(DB::raw('SUM(CASE WHEN upvote = 1 THEN 1 ELSE 0 END)'));
            }])
            ->withExists([
                'upvotes as has_upvoted' => function ($query) {
                    $query->where(['user_id' => $this->user_id, 'upvote' => 1]);
                },
                'upvotes as has_downvoted' => function ($query) {
                    $query->where(['user_id' => $this->user_id, 'upvote' => 0]);
                },
            ]);
    
        return $query->latest('id')->paginate($perPage ?: 10);
    }

    public function create(array $data) : Model
    {
        $data['user_id'] = $this->user_id;

        return $this->model->create($data);
    }

    public function show(Model $model): ?Model
    {
        $model->load('comments.user')
            ->loadCount(['upvotes as upvote_count' => function ($query) {
                $query->select(DB::raw('SUM(CASE WHEN upvote = 1 THEN 1 ELSE 0 END)'));
            }])
            ->loadExists([
                'upvotes as has_upvoted' => function ($query) {
                    $query->where(['user_id' => $this->user_id, 'upvote' => 1]);
                },
                'upvotes as has_downvoted' => function ($query) {
                    $query->where(['user_id' => $this->user_id, 'upvote' => 0]);
                },
            ]);

        return $model;
    }
}
