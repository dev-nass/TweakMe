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
            ->whereOr('sender_id', '=', Auth::user()->id)
            ->where('status', '=', 'accepted')
            ->get();

        return view('friends.index', [
            'requests' => $requests,
        ]);
    }


    //
    public function destroy(AddFriendRequest $addFrientRequest)
    {

        $addFrientRequest->delete();

        return to_route('friends.index');
    }
}
