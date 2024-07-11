<?php

use App\Http\Controllers\PostSlugController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/{post:slug}', PostSlugController::class)->name('posts.show');
