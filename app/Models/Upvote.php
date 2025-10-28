<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    public $timestamps = false;

    protected $fillable = ['feature_id', 'user_id', 'upvote'];
    
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
