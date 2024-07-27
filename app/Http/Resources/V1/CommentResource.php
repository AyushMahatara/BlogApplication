<?php

namespace App\Http\Resources\V1;

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
            'comment_id' => $this->id,
            'feedback'    => $this->feedback,
            'post'          => $this->whenLoaded('commentable', function () {
                return [
                    'post_id'        => $this->commentable->id,
                    'post_title'     => $this->commentable->title,
                    'post_description' => $this->commentable->description,
                    'post_author'    => $this->commentable->user->name, // Assuming the post has a 'user' relation for author
                ];
            }),
        ];
    }
}
