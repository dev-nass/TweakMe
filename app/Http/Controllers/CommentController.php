<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{

    /**
     * Used for listening to a form submit
     * and stores a comment
     * ...
     * The create for this is on the posts/show.blade.php
     */
    public function store(Request $request, Post $post)
    {

        $request->validate([
            'content' => ['required', 'string', 'max:255']
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ]);

        Notification::create([
            'user_id' => $post->user->id,
            'notifiable_id' => $comment->id,
            'notifiable_type' => Comment::class,
            'data' => [
                'commenter_name' => Auth::user()->username,
                'post_id'        => $comment->post_id,
                'excerpt'        => Str::limit('commented on your post', 50),
            ],
        ]);

        return redirect()->back();
    }



    /**
     * Used for loading the view for 
     * editing a comment
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }



    /**
     * Used for listening to a form submit and
     * updates a comment
     */
    public function update(Request $request, Comment $comment)
    {

        $content = $request->validate([
            'content' => ['required', 'string', 'max:255'],
        ]);

        $comment->update($content);

        return to_route('posts.show', [$comment->post->id]);
    }



    /**
     * Used for deleting a comment on a 
     * single post
     */
    public function destroy(Comment $comment)
    {

        $comment->delete();

        return redirect()->back();
    }
}
