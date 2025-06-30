<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateUser;

class PostTest extends TestCase
{

    use RefreshDatabase;
    use CreateUser;

    private User $user;

    /**
     * Added because private User $user = $this->createUser();
     * is not possible. We can't access $this on property assignment
    */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
    

    
    public function test_homepage_contains_posts(): void
    {

        $post = Post::factory()->create([
            'user_id' => $this->user->id,
            'title' => 'Hello World',
            'content' => 'This is an example content',
            'audience' => 'public'
        ]);

        $response = $this->actingAs($this->user)->get(route('index'));

        $response->assertStatus(200);
        $response->assertDontSee('No Posts Yet');
        $response->assertViewHas('posts', function($collection) use ($post){
            return $collection->contains($post);
        });
    }



    public function test_homepage_pagination()
    {

        $post = Post::factory(11)->create();
        $lastPost = $post->last();

        $response = $this->actingAs($this->user)->get(route('index'));

        $response->assertStatus(200);
        $response->assertViewHas('posts', function($collection) use ($lastPost) {
            return !$collection->contains($lastPost);
        });
    }
}
