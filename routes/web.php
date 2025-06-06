<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/notifcations', function () {
    return view('notification');
})->name('notification');

Route::get('/friends/requests', function () {
    return view('friends.friend-requests');
})->name('friends.friend-requests');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

Route::get('/registration', function () {
    return view('auth.registration');
})->name('registration');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');