<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    /**
     * Loads the view for creating
     * a new post
     */
    public function create()
    {
        return view('posts.create');
    }


    /**
     * Listen to the form submit to
     * store a new post
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string'],
        ]);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // allows multiple file upload now
        if ($request->hasFile('attachments')) {
            foreach ($request->attachments as $attachment) {
                $path = $attachment->store('images', 'public');
                // $dir = Storage::disk('public')->store('images', 'public');

                Attachment::create([
                    'post_id' => $post->id,
                    'dir' => $path,
                    'type' => 'image' // should be changed later
                ]);
            }
        }

        $tagIds = [];
        $tags = explode(',', $request->tags);
        foreach ($tags as $tag) {
            $tag = trim($tag);

            // skips empty tag
            if (! $tag) {
                continue;
            }

            $newTag = Tag::firstOrCreate([
                'name' => $tag
            ]);

            $tagIds[] = $newTag->id;
        }

        $post->tags()->attach($tagIds);

        return to_route('index');
    }


    /**
     * Used for showing a specific 
     * Post and later on its comments too
    */
    public function show(Post $post)
    {

        $tagName = [];

        foreach ($post->tags as $tag) {
            $tagName[] = $tag->name;
        }


        return view('posts.show', [
            'post' => $post,
            'tagName' => $tagName
        ]);
    }


    /**
     * Loads the view and specific record
     * for Editing
     */
    public function edit(Post $post)
    {

        $tagName = [];

        foreach ($post->tags as $tag) {
            $tagName[] = $tag->name;
        }


        return view('posts.edit', [
            'post' => $post,
            'tagName' => $tagName
        ]);
    }


    /**
     * Listens to a form submission
     * to Update a post and tag if neccessary
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string'],
        ]);

        $post->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // could be useful if we don't use sync, but sync already handles
        // attach and detach
        // $post->tags()->detach();

        $tagIds = [];
        $tags = explode(',', $request->tags);
        foreach ($tags as $tag) {
            $tag = trim($tag);

            // skips empty tag
            if (! $tag) {
                continue;
            }

            $newTag = Tag::firstOrCreate([
                'name' => $tag
            ]);

            $tagIds[] = $newTag->id;
        }

        $post->tags()->sync($tagIds);

        return to_route('index');
    }


    /**
     * Delete a specific Post
    */
    public function destroy(Post $post)
    {

        // delete each atachment of the post
        foreach($post->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->dir);
        }

        $post->delete();

        return to_route('index');
    }
}
