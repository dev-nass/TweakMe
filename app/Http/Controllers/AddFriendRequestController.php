<?php

namespace App\Http\Controllers;

use App\Models\AddFriendRequest;
use App\Models\AddFrientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddFriendRequestController extends Controller
{

    //
    public function index()
    {

        $requests = Auth::user()->friendRequestsReceived()
            ->where('status', '=', 'pending')
            ->get();

        return view('friendRequests.index', [
            'requests' => $requests,
        ]);
    }



    //
    public function update(AddFriendRequest $addFrientRequest)
    {

        $request = $addFrientRequest->update([
            'status' => 'accepted'
        ]);

        return to_route('user-profile.posts', [$addFrientRequest->sender_id])->with('request', 'accepted');
    }


    //
    public function destroy(AddFriendRequest $addFrientRequest)
    {

        $addFrientRequest->delete();

        return to_route('friend-request.index');
    }
}
