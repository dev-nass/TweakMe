<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\TestCase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        // $route = Route::getRoutes()->getByName('index');
        // dump([
        //     'uri' => $route->uri,
        //     'action' => $route->getAction(),
        //     'contoller' => $route->getController()
        // ]);

        // Debug: See all available routes
        // dump(Route::getRoutes()->getRoutesByName());

        // Create and authenticate a user
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('index'));

        $response = $this->get(route('posts.create'));

        $response->assertStatus(200);
    }

}
