<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    /**
     * Allows the user who posted the post
     * to edit and updates it
    */
    public function update(User $user, Post $post)
    {
        return $post->user->id === $user->id;
    }

    public function delete(User $user, Post $post)
    {
        return $post->user->id === $user->id;
    }
}
