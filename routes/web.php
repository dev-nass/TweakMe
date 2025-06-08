<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/',  function() {
    return view('index');
})->name('index');

Route::view('/notifications', 'notification')->name('notification');

Route::get('/friends/requests', function () {
    return view('friends.friend-requests');
})->name('friends.friend-requests');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/registration', 'create')->name('registration');
    Route::post('/registration', 'store')->name('registration');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login');
    Route::delete('/logout', 'destroy')->name('logout');
});
