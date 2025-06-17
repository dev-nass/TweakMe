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


    /**
     * @param $user retrieves the record of the receiver
     * @return: redirect back
     */
    public function store(User $user)
    {

        $request = AddFriendRequest::firstOrCreate([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $user->id,
            'status' => 'pending'
        ]);

        return to_route('user-profile.posts', [$user->id])->with('request',  $request);
    }



    //
    public function update(AddFriendRequest $addFriendRequest)
    {

        $request = $addFriendRequest->update([
            'status' => 'accepted'
        ]);

        return to_route('user-profile.posts', [$addFriendRequest->sender_id])->with('request', 'accepted');
    }


    //
    public function destroy(AddFriendRequest $addFriendRequest)
    {

        $addFriendRequest->delete();

        return back();
    }
}
