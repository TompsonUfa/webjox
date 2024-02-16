<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('user', [UserController::class, 'index']);

});

Route::get('posts', [PostController::class, 'index'])->name('posts.list');

Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
