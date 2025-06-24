<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Description: Primarily used for route::cache but
     * as per ChatGPT suggestion but still doeen't work
    */
    public function __invoke()
    {
        $posts = Post::with(['user.friendRequestsSent', 'user.friendRequestsReceived', 'user', 'retweaks', 'comments', 'likes', 'bookmarks', 'tags', 'attachments'])
            ->inRandomOrder()
            ->whereIn('audience', ['public', 'friends'])
            ->simplePaginate(10);

        return view('index', [
            'posts' => $posts
        ]);
    }
}
