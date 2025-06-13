<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class RetweakPolicy
{
    
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Post $post)
    {
        return $post->user->id === $user->id;
    }

    public function delete(User $user, Post $post)
    {
        return $post->user->id === $user->id;
    }
}
