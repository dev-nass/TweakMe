<?php

use App\Http\Controllers\AddFriendRequestController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\auth\SocialiteController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetweakController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsersProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    Route::get('/',  function () {
        return view('index', [
            'posts' => Post::with(['user', 'retweaks'])
                ->inRandomOrder()
                ->whereIn('audience', ['public', 'friends'])
                ->get(),
        ]);
    })->name('index');

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications', 'index')->name('notifications');
        Route::delete('/notifications/{notification}', 'destroy')->name('notifications.delete');
    });

    Route::controller(AddFriendRequestController::class)->group(function () {
        Route::get('/friends/requests', 'index')
            ->name('friend-request.index');
        Route::post('/friends/request/{user}', 'store')
            ->name('friend-request.store');
        Route::put('/friends/requests/{addFriendRequest}', 'update')
            ->name('friend-request.update');
        Route::delete('/friends/requests/{addFriendRequest}', 'destroy')
            ->name('friend-request.delete');
    });

    Route::controller(SearchController::class)->group(function () {
        Route::get('/search', 'index')->name('search.index');
        Route::get('/search/user', 'search')->name('search.user');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('/post/create', 'create')
            ->name('posts.create');
        Route::post('/posts', 'store')
            ->name('posts.store');
        Route::get('/post/{post}', 'show')
            ->name('posts.show');
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

    Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])
        ->name('attachments.delete');

    Route::controller(CommentController::class)->group(function () {
        Route::get('/posts/{post}/comment', 'store')->name('comments.store');
        Route::get('/posts/comment/{comment}/edit', 'edit')->name('comments.edit');
        Route::put('/posts/comment/{comment}', 'update')->name('comments.update');
        Route::delete('/posts/comments/{comment}', 'destroy')->name('comments.delete');
    });

    Route::controller(LikeController::class)->group(function () {
        Route::post('/posts/{post}/like', 'store')->name('likes.store');
        Route::delete('/posts/{post}/unlike', 'destroy')->name('likes.delete');
    });

    Route::controller(RetweakController::class)->group(function () {
        Route::get('/retweak/post/{post}', 'create')->name('retweaks.create');
        Route::post('/retweak/post/{post}', 'store')->name('retweaks.store');
    });

    Route::controller(BookmarkController::class)->group(function () {
        Route::post('/posts/{post}/bookmark', 'store')->name('bookmarks.store');
        Route::delete('/posts/{post}/unbookmark', 'destroy')->name('bookmarks.delete');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/{user}', 'posts')->name('profile.posts');
        Route::get('/profile/{user}/retweaks', 'retweaks')->name('profile.retweaks');
        Route::get('/profile/{user}/bookmarks', 'bookmarks')->name('profile.bookmarks');
        Route::get('/profile/{user}/likes', 'likes')->name('profile.likes');
    });

    Route::controller(EditProfileController::class)->group(function () {
        Route::get('/profile/edit/{user}', 'edit')->name('profile-edit.edit');
        Route::put('/profile/edit/{user}', 'update')->name('profile-edit.update');
    });

    Route::controller(UsersProfileController::class)->group(function () {
        Route::get('/user/{user}/profile', 'posts')->name('user-profile.posts');
        Route::get('/user/{user}/profile/retweaks', 'retweaks')->name('user-profile.retweaks');
    });

    Route::controller(FriendController::class)->group(function () {
        Route::get('/friends', 'index')->name('friends.index');
        Route::get('/friends/{user}/profile', 'posts')->name('friends.posts');
        Route::get('/friends/{user}/retweak', 'retweaks')->name('friends.retweaks');
        Route::delete('/friends/{addFrientRequest}', 'destroy')->name('friends.delete');
    });
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

Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
});
