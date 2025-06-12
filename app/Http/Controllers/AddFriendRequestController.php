<?php

namespace App\Http\Controllers;

use App\Models\AddFriendRequest;
use App\Models\AddFrientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddFriendRequestController extends Controller
{

    //
    public function index()
    {

        $requests = AddFriendRequest::where('receiver_id', '=', Auth::user()->id)
            ->where('status', '=', 'pending')
            ->get();

        return view('friends.friend-requests', [
            'requests' => $requests,
        ]);
    }


    //
    public function update(AddFriendRequest $addFrientRequest)
    {

        $addFrientRequest->update([
            'status' => 'accepted'
        ]);

        return redirect()->back();

    }


    //
    public function destroy(AddFriendRequest $addFrientRequest)
    {

        $addFrientRequest->delete();

        return to_route('friends.friend-requests');
    }
}
