<?php

namespace App\Services;

use App\Models\Attachment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PostService
{

    /**
     * @param $validated contains the validated attributes from the PostController
     * @param $attachment will contains the files, if there's any
     * @return Post the newly created post
    */
    public function createPost(array $validated, $attachment = null)
    {

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'audience' => $validated['audience']
        ]);

        if ($attachment) {
            $this->handleAttachments($post, $attachment['attachments']);
        }
        
        // Handle tags
        $this->handleTags($post, $validated['tags']);

        return $post;
    }



    /**
     * @param Post $post contians the actual record of post where the attachment is going to be associated into
     * @param $attachements will contain the files that the user uploaded, if there's any
     * @return void 
    */
    public function handleAttachments(Post $post, $attachments)
    {

        foreach ($attachments as $attachment) {
            // from documentation
            // $dir = Storage::disk('public')->store('images', 'public');
            $path = $attachment->store('images/posts', 'public');
            
            // added by chatGPT
            // Get MIME type like "image/png", "video/mp4", etc.
            $mime = $attachment->getClientMimeType(); // or $attachment->getMimeType()

            // Get the general type (e.g., "image", "video", "application")
            $type = explode('/', $mime)[0];

            Attachment::create([
                'post_id' => $post->id,
                'dir' => $path,
                'type' => $type // should be changed later
            ]);
        }
    }



    /**
     * @param Post $post is for the actual post record where the tag is being associated with
     * @pram string $tags will contain the string of tags that the user typed (comma separated)
     * @return void
    */
    public function handleTags(Post $post, $tags)
    {

        $tagIds = [];
        $tags = explode(',', $tags);
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
    }
}
