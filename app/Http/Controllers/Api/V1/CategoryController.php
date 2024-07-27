<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryResource;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Requests\V1\StoreCategoryRequest;
use App\Http\Requests\V1\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->all()));
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return response()->json([
            'message' => 'Category Updated Successfully'
        ], 200);
    }

    public function destroy(Category $category)
    {
        if (auth()->check() && auth()->user()->hasRole('admin'))
            $category->delete();
        else
            return response()->json(['error' => 'Unauthorized'], 403);

        return response([
            "message" => "Category Deleted Successfully"
        ]);
    }
}
