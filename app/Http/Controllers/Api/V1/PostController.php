<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;
use App\Http\Requests\V1\StorePostRequest;
use App\Http\Requests\V1\UpdatePostRequest;
use App\Http\Resources\V1\PostCollection;
use App\Models\Tag;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $queryParams = $request->except('page');
        $posts = QueryBuilder::for(Post::class)
            ->allowedIncludes(['category', 'tags', 'user'])
            ->allowedFilters([
                'title',
                'category.name',
                'tags.name',
                'user.name'
            ])
            ->paginate()->appends($queryParams);;
        return new PostCollection($posts);
    }

    public function store(StorePostRequest $request)
    {
        $user = auth()->user();
        $post = Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'user_id' => $user->id,
        ]);

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }
        return new PostResource($post);
    }

    public function show(Post $post)
    {

        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $post->update($request->only(['title', 'description', 'category_id']));
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        return response()->json([
            'message' => 'Post Updated Successfully'
        ], 200);
    }


    public function destroy(Post $post)
    {
        //checking if the user is the one that created the post
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
