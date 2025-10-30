<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureListResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this);
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'user'          => new UserResource($this->user),
            'created_at'    => $this->created_at->format('Y-m-d H:i:s'),
            'upvote_count'  => $this->upvote_count ?: 0,
            'has_upvoted'   => (boolean) $this->has_upvoted,
            'has_downvoted' => (boolean) $this->has_downvoted,
        ];
    }
}
