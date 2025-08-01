<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    /**
     * Retrieves the user who
     * created the Post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Used for inserting or retrieving a Posts
     * attachments be a image or video
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * Retrieves the likes that a single
     * Post have
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    /**
     * Returns a boolean and check if the user
     * has liked the post or not
     */
    public function hasLikedByUser()
    {
        // $post = Post::findOrFail($post_id);

        // foreach ($post->likes as $like) {
        //     if (Auth::user()->id === $like->user_id) {
        //         return true;
        //     }
        // }

        // return false;

        if (! Auth::user()) {
            return false;
        }

        return $this->likes()->where('user_id', '=', Auth::user()->id)->exists();
    }


    /**
     * Used for retrieving a post
     * comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Return a single retweak, used within 
     * index.blade.php for retrieving a post
     * record's retweak, if (is_retweak == 1)
     */
    public function retweak()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    /**
     * Returns a post retweaks, not used
     * yet
     */
    public function retweaks()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }


    /**
     * 
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }


    //
    public function notification()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
