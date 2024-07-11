<?php

use App\Http\Controllers\PostSlugController;
use App\Http\Middleware\EnsurePostViewable;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/{post:slug}', PostSlugController::class)
    ->middleware(EnsurePostViewable::class)
    ->name('posts.show');
