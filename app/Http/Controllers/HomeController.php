<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Description: Primarily used for route::cache but
     * as per ChatGPT suggestion but still doesn't work
    */
    public function __invoke()
    {

        $query = Post::with(['user.friendRequestsSent', 'user.friendRequestsReceived', 'user', 'retweaks', 'comments', 'likes', 'bookmarks', 'tags', 'attachments'])
            ->whereIn('audience', ['public', 'friends']);

        // only randomize the element in non testing environment
        if(!app()->environment('testing')) {
            $query->inRandomOrder();
        } else {
            $query->latest();
        }

        $posts = $query->simplePaginate(10);

        return view('index', [
            'posts' => $posts
        ]);
    }
}
