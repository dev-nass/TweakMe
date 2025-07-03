<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
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
        $response->assertViewHas('posts', function ($collection) use ($post) {
            return $collection->contains($post);
        });
    }



    public function test_homepage_pagination()
    {

        $post = Post::factory(11)->create();
        $lastPost = $post->last();

        $response = $this->actingAs($this->user)->get(route('index'));

        $response->assertStatus(200);
        $response->assertViewHas('posts', function ($collection) use ($lastPost) {
            return !$collection->contains($lastPost);
        });
    }


    public function test_create_post_can_be_view()
    {
        $response = $this->actingAs($this->user)->get(route('posts.create'));

        $response->assertStatus(200);
        $response->assertViewIs('posts.create');
    }


    /**
     * Checks the Post creation including also its Tags
     */
    public function test_store_post_successful()
    {

        // we can't use factory here, because we have to use the $this->user,
        // if we use the post factory, it will create its own user, but we can also
        // the that on $this->actingAs, but I just don't want to.
        $post = [
            'audience' => 'public',
            'title' => 'Post Title 123',
            'content' => 'Sample content of my post',
            'tags' => 'glad,testing'
        ];

        $postz = 'hjahjdhajdh';
        

        // we are storing the data here
        $response = $this->actingAs($this->user)->post(route('posts.store', $post));

        // we redirect after the post store
        $response->assertStatus(302);
        $response->assertRedirect(route('index'));

        // checks if the database has the data
        $this->assertDatabaseHas('posts', [
            'audience' => 'public',
            'title' => 'Post Title 123',
            'content' => 'Sample content of my post',
            // we can't add tags here
        ]);

        // gets the newly crated post
        $lastPost = Post::latest()->first();

        $tags = explode(',', $post['tags']);
        foreach ($tags as $tag) {
            $tag = trim($tag);

            // check if the table has the data
            $this->assertDatabaseHas('tags', [
                'name' => $tag
            ]);

            // Check if the post-tag relationship exists in pivot table
            $tagId = Tag::where('name', '=', $tag)->pluck('id')->first();
            $this->assertDatabaseHas('post_tag', [
                'post_id' => $lastPost->id,
                'tag_id' => $tagId,
            ]);
        }


        $this->assertEquals($post['title'], $lastPost->title);
        $this->assertEquals($post['content'], $lastPost->content);
    }


    public function test_edit_contains_correct_values()
    {

        $post = Post::factory()->create();

        $response = $this->actingAs($post->user)->get(route('posts.edit', $post));

        $response->assertStatus(200);
        $response->assertSee("value=\"{$post->title}\"", false);
        $response->assertSee($post->content, false);
        $response->assertViewHas('post', $post);
    }
    
    
    // sad path
    public function test_post_update_throws_validation_error_redirects_back_to_edit_form()
    {

        $post = Post::factory()->create([
            'title' => 'Valid Title',
            'content' => 'Valid Content',
        ]);

        $tag = Tag::factory()->create([
            'name' => 'glad'
        ]);
        $post->tags()->attach([$tag->id]);

        // Then send INVALID data in the update request
        $invalidData = [
            'title' => '', // or null, or don't include it
            'content' => '', // or null, or don't include it
            'tags' => ''
        ];

        $response = $this->actingAs($post->user)->put(route('posts.update', $post), $invalidData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'content', 'tags']);
        $response->assertRedirect();
    }


    public function test_post_delete()
    {

        $post = Post::factory()->create();


        $response = $this->actingAs($post->user)->delete(route('posts.delete', $post));

        $response->assertStatus(302);
        $response->assertRedirect();

        $this->assertDatabaseMissing('posts', $post->getAttributes());
    }
}
