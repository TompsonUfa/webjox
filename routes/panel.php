<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ImageController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('posts', [PostController::class, 'index']);

    Route::get('posts/{post}', [PostController::class, 'show']);

    Route::middleware('permission:update-tasks')->group(function (){

        Route::put('posts/{post}', [PostController::class, 'update']);

        Route::get('images', [ImageController::class, 'index']);

        Route::post('images', [ImageController::class, 'store']);

        Route::delete('images/{image}', [ImageController::class, 'destroy']);

    });

    Route::middleware('permission:create-tasks')->post('posts', [PostController::class, 'store']);

    Route::middleware('permission:delete-tasks')->delete('posts/{post}', [PostController::class, 'destroy']);

    Route::get('tags', [TagController::class, 'index']);

});
