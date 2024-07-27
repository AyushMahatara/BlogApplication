<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\CategoryController;


Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => ['role:admin']], function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('tags', TagController::class);
    });

    Route::apiResource('posts', PostController::class);
    Route::apiResource('comment', CommentController::class);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
});

// users, posts, categories, tags and comment
