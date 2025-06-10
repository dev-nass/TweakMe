<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    //
    public function store(Request $request, Post $post)
    {

        $request->validate([
            'content' => ['required', 'string', 'max:255']
        ]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ]);

        return redirect()->back();
    }



    public function edit(Comment $comment)
    {
        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }



    public function update(Request $request, Comment $comment)
    {

        $content = $request->validate([
            'content' => ['required', 'string', 'max:255'],
        ]);

        $comment->update($content);

        return to_route('posts.show', [$comment->post->id]);
    }
}
