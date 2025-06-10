<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/',  function () {
    return view('index', [
        'posts' => Post::with('user')->latest()->get(),
    ]);
})->name('index');

Route::view('/notifications', 'notification')->name('notification');

Route::get('/friends/requests', function () {
    return view('friends.friend-requests');
})->name('friends.friend-requests');

Route::controller(PostController::class)->group(function () {
    Route::get('/post/create', 'create')->name('posts.create');
    Route::post('/posts', 'store')->name('posts.store');
    Route::get('/post/{post}', 'show')->name('posts.show');
    Route::get('/posts/{post}/edit', 'edit')->name('posts.edit');
    Route::put('/posts/{post}', 'update')->name('posts.update');
    Route::delete('/posts/{post}', 'destroy')->name('posts.delete');
});

Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('likes.delete');
Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('attachments.delete');

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/registration', 'create')->name('registration');
    Route::post('/registration', 'store')->name('registration');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login');
    Route::delete('/logout', 'destroy')->name('logout');
});
