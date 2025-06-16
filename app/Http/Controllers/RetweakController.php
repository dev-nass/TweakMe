<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\Tag;
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
            'content' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string'],
            'audience' => ['required', 'string']
        ]);

        $retweak = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'parent_id' => $post->id,
            'is_retweak' => true,
            'audience' => $request->audience,
        ]);

        Notification::create([
            'user_id' => $post->user->id,
            'notifiable_id' => $retweak->id,
            'notifiable_type' => Post::class,
            'data' => [
                'commenter_name' => Auth::user()->username,
                'post_id'        => $retweak->post_id,
                'excerpt'        => Str::limit('has retweak your post', 50),
            ],
        ]);

        $tagIds = [];
        $tags = explode(',', $request->tags);
        foreach($tags as $tag) {
            $tag = trim($tag);

            if(! $tag) {
                continue;
            }

            $newTag = Tag::firstOrCreate([
                'name' => $tag
            ]);

            $tagIds[] = $newTag->id;
        }

        $retweak->tags()->attach($tagIds);

        return to_route('index');
    }
}
