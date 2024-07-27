<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    public function update(User $user, Comment $comment): bool
    {
        // Users can update their own comments
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        // Users can delete their own comments, or post owners can delete any comment
        return $user->id === $comment->user_id || $user->id === $comment->commentable->user_id;
    }
}
