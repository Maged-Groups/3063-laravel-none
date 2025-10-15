<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index');

// Route::view('posts', 'posts.index')->name('all-posts');
// Route::view('posts/{post}', 'posts.show')->name('single-post');


Route::resources([
    'posts' => PostController::class
]);