<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\Retweak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RetweakController extends Controller
{
    //
    public function create(Post $post)
    {
        return view('retweaks.create', [
            'post' => $post,
        ]);
    }

    //
    public function store(Request $request, Post $post)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255']
        ]);

        $retweak = Retweak::create([
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        Notification::create([
            'user_id' => $post->user->id,
            'notifiable_id' => $retweak->id,
            'notifiable_type' => Retweak::class,
            'data' => [
                'commenter_name' => Auth::user()->username,
                'post_id'        => $retweak->post_id,
                'excerpt'        => Str::limit('has retweak your post', 50),
            ],
        ]);

        return to_route('index');
    }
}
