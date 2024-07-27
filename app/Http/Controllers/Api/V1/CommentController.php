<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V1\CommentResource;
use App\Http\Requests\V1\StoreCommentRequest;
use App\Http\Requests\V1\UpdateCommentRequest;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = $post->comments()->create([
            'feedback' => $request->input('feedback'),
            'user_id' => Auth::id(),
        ]);
        $comment->load('commentable');
        return new CommentResource($comment);
    }

    public function show(Comment $comment)
    {
        $comment->load('commentable');
        return new CommentResource($comment);
        // return response()->json($comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        Gate::authorize('update', $comment);
        $comment->update($request->only('feedback'));
        $comment->load('commentable');
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {

        Gate::authorize('delete', $comment);
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
