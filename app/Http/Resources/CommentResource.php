<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'feature_id'    => $this->feature_id,
            'user_id'       => $this->user_id,
            'comment'       => $this->comment,
            'created_at'    => $this->created_at->format('Y-m-d H:i:s'),
            'user'          => new UserResource($this->user)
        ];
    }
}
