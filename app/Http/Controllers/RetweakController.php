<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Retweak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        Retweak::create([
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return to_route('index');
    }
}
