<?php

use App\Models\Post;
use App\Models\User;


it('belongs to a user', function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($post->user->is($user))->toBeTrue();
});
