<?php

use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\TagController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::group(['middleware' => ['auth:sanctum']], function () {
});

// users, posts, categories, tags and comment

Route::apiResource('posts', PostController::class);
// Route::apiResource('users', UserController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('tags', TagController::class);
// Route::apiResource('tags', TagController::class);
