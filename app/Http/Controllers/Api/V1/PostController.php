<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StorePostRequest;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return new PostResource(Post::all());
    }

    public function store(StorePostRequest $request)
    {
        return new PostResource(Post::create($request->all()));
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }
}
