<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{


    //
    public function posts(User $user)
    {

        $posts = $user->posts()->get();


        return view('profiles.posts', [
            'posts' => $posts,
        ]);
    }


    //
    public function retweaks(User $user)
    {

        $retweaks = $user->retweaks()->get();

        return view('profiles.retweaks', [
            'retweaks' => $retweaks,
        ]);
    }


}
