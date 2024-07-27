<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreTagRequest;
use App\Http\Requests\V1\UpdateTagRequest;
use App\Http\Resources\V1\TagCollection;
use App\Http\Resources\V1\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return new TagCollection(Tag::paginate());
    }

    public function store(StoreTagRequest $request)
    {
        return new TagResource(Tag::create($request->all()));
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->all());
        return response()->json([
            'message' => 'Tag Updated Successfully'
        ], 200);
    }

    public function destroy(Tag $tag)
    {
        if (auth()->check() && auth()->user()->hasRole('admin'))
            $tag->delete();
        else
            return response()->json(['error' => 'Unauthorized'], 403);

        return response([
            "message" => "Tag Deleted Successfully"
        ]);
    }
}
