<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{

    //
    public function store(Post $post)
    {

        $post->bookmarks()->firstOrCreate([
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json(['message' => 'Bookmarked']);
    }


    //
    public function destroy(Post $post)
    {

        $post->bookmarks()->where('user_id', '=', Auth::user()->id)->delete();

        return response()->json(['message' => 'Unbookmarked']);
    }
}
