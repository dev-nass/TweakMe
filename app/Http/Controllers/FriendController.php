<?php

namespace App\Http\Controllers;

use App\Models\AddFriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    /**
     * This is responsible for the 
     * profile preview
     */
    public function index()
    {
        $requests = AddFriendRequest::where('receiver_id', '=', Auth::user()->id)
            ->where('status', '=', 'accepted')
            ->get();

        return view('friends.index', [
            'requests' => $requests,
        ]);
    }


    public function posts(User $user)
    {

        $request = AddFriendRequest::where('receiver_id', '=', Auth::user()->id)
            ->where('status', '=', 'accepted')
            ->first();

        $posts = $user->posts()->get();

        return view('friends.posts', [
            'request' => $request,
            'user' => $user,
            'posts' => $posts,
        ]);
    }


    public function retweaks(User $user)
    {

        $request = AddFriendRequest::where('receiver_id', '=', Auth::user()->id)
            ->where('status', '=', 'accepted')
            ->first();

        $posts = $user->retweaks()->get();

        return view('friends.retweaks', [
            'request' => $request,
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    //
    public function destroy(AddFriendRequest $addFrientRequest)
    {

        $addFrientRequest->delete();

        return to_route('friends.index');
    }
}
