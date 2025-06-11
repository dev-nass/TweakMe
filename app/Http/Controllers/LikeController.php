<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    //
    public function store(Post $post)
    {
        // MY APPROACH
        // Like::create([
        //     'post_id' => $post->id,
        //     'user_id' => Auth::user()->id,
        // ]);

        // return to_route('index');

        // AJAX APPROACH
        $post->likes()->firstOrCreate([
            'user_id' => Auth::user()->id
        ]);

        return response()->json(['message' => 'Liked']);
    }

    public function destroy(Post $post)
    {

        // MY APPROACH
        // $like = Like::where('post_id', '=', $post->id)
        //     ->where('user_id', '=', Auth::user()->id)
        //     ->first();
        
        // $like->delete();
     
        // return to_route('index');

        // AJAX APPROACH
        $post->likes()->where('user_id', '=', Auth::user()->id)->delete();

        return response()->json(['message' => 'Unliked']);
    }
}
