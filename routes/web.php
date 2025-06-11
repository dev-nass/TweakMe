<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RetweakController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/',  function () {
    return view('index', [
        'posts' => Post::with('user')->latest()->get(),
    ]);
})->name('index')->middleware('auth');

Route::view('/notifications', 'notification')->name('notification');

Route::get('/friends/requests', function () {
    return view('friends.friend-requests');
})->name('friends.friend-requests');

Route::controller(PostController::class)->group(function () {
    Route::get('/post/create', 'create')->name('posts.create');
    Route::post('/posts', 'store')->name('posts.store');
    Route::get('/post/{post}', 'show')->name('posts.show');
    Route::get('/posts/{post}/edit', 'edit')
        ->name('posts.edit')
        ->can('update', 'post');
    Route::put('/posts/{post}', 'update')
        ->name('posts.update')
        ->can('update', 'post');
    Route::delete('/posts/{post}', 'destroy')
        ->name('posts.delete')
        ->can('delete', 'post');
});

Route::controller(CommentController::class)->group(function () {
    Route::get('/posts/{post}/comment', 'store')->name('comments.store');
    Route::get('/posts/comment/{comment}/edit', 'edit')->name('comments.edit');
    Route::put('/posts/comment/{comment}', 'update')->name('comments.update');
    Route::delete('/posts/comments/{comment}', 'destroy')->name('comments.delete');
});

Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/posts/{post}/unlike', [LikeController::class, 'destroy'])->name('likes.delete');
Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('attachments.delete');

Route::controller(RetweakController::class)->group(function () {
    Route::get('/retweak/post/{post}', 'create')->name('retweaks.create');
    Route::post('/retweak/post/{post}', 'store')->name('retweaks.store');
});

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/registration', 'create')->name('registration');
    Route::post('/registration', 'store')->name('registration');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login');
    Route::delete('/logout', 'destroy')->name('logout');
});
