<?php

namespace App\Http\Controllers;

use App\Models\AddFriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller is used for accessing other users
 * profile through (post, add friend, search, friend list)
*/
class UsersProfileController extends Controller
{

    /**
     * @param $user responsible for retrieving the $user record
     * and use it for fetching their friend requests
    */
    public function posts(User $user)
    {

        $request = AddFriendRequest::where('receiver_id', '=', $user->id)
            ->orWhere('sender_id', '=', $user->id)
            ->first();
        
        $posts = $user->posts()->get();

        return view('usersProfile.posts', [
            'request' => $request,
            'user' => $user,
            'posts' => $posts,
        ])->with('ownProfile', false);
    }


    public function retweaks(User $user)
    {

        $request = AddFriendRequest::where('receiver_id', '=', Auth::user()->id)
            ->where('sender_id', '=', $user->id)
            ->first();

        $posts = $user->retweaks()->get();

        return view('usersProfile.retweaks', [
            'request' => $request,
            'user' => $user,
            'posts' => $posts,
        ])->with('ownProfile', false);
    }
}
