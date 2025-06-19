<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

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
     * Description: Listen to the form submit to store a new post
     * @param $request expect the inputs from the view
     * @param $postService class for post creation logic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, PostService $postService)
    {

        $validatedAttr = $request->validate([
            'audience' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string'],
        ]);

        // .* - checks the attachments arrays
        $validatedAttachments = $request->validate([
            'attachments.*' => ['file', File::types(['png', 'jpg', 'webp', 'mp4'])],
        ]);


        $postService->createPost($validatedAttr, $validatedAttachments);

        return to_route('index');
    }


    /**
     * Description: Used for showing a specific Post and later on its comments too
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
     * Description: Listens to a form submission to Update a post and tag if neccessary
     * @param $request expects the input from the view
     * @param $post contain the post record instance
     * @param $postService class for post update logic
     */
    public function update(Request $request, Post $post, PostService $postService)
    {

        $validatedAttr = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string'],
        ]);

       
        $postService->updatePost($validatedAttr, $post);

        return to_route('index');
    }


    /**
     * Description: Delete a specific Post
     */
    public function destroy(Post $post)
    {

        // delete each atachment of the post
        foreach ($post->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->dir);
        }

        $post->delete();

        return to_route('index');
    }
}
