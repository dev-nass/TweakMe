<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller is used for Auth user profile
*/
class ProfileController extends Controller
{


    /**
     * For the posts page within the profile
    */
    public function posts(User $user)
    {
        
        $posts = $user->posts()->get();


        return view('profiles.posts', [
            'posts' => $posts,
        ])->with('ownProfile', true);
    }


    /**
     * For the retweaks post page within the profile
    */
    public function retweaks(User $user)
    {

        $posts = $user->retweaks()->get();

        return view('profiles.retweaks', [
            'posts' => $posts,
        ]);
    }


    /**
     * For the bookmarked posts within the profile
    */
    public function bookmarks(User $user)
    {

        $bookmarks = $user->bookmarks()->get();

        return view('profiles.bookmarks',[
            'bookmarks' => $bookmarks,
        ]);
    }


    /**
     * For the bookmarked posts within the profile
    */
    public function likes(User $user)
    {

        $likes = $user->likes()->get();

        return view('profiles.likes',[
            'likes' => $likes,
        ]);
    }

}
