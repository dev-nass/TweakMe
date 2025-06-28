<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SmokeTest extends TestCase
{

     use RefreshDatabase;

    public function test_simple_get_routes ()
    {

        $routes = [
            'index',
            'posts.create',
        ];

        $user = User::factory()->create();

        foreach ($routes as $route) {
            // Chain actingAs() and get() in one call
            $response = $this->actingAs($user)->get(route($route));

            // Debug which route is failing
            if ($response->getStatusCode() !== 200) {
                dump([
                    'failing_route' => $route,
                    'status_code' => $response->getStatusCode(),
                    'content' => $response->getContent()
                ]);
            }

            $response->assertStatus(200, "Route '{$route}' failed");
        }
    }



    public function test_parametarized_get_routes()
    {

        $user = User::factory()->create();
        $post = Post::factory()->create();

        $routes = [
            ['posts.show', ['post' => $post->id]]
        ];

        foreach ($routes as [$route, $param]) {
            $response = $this->actingAs($user)->get(route($route, $param));

            if ($response->getStatusCode() !== 200) {
                dump([
                    'failing_route' => $route,
                    'params' => $param,
                    'status_code' => $response->getStatusCode(),
                    'content' => $response->getContent()
                ]);
            }

            $response->assertStatus(200, "Route '{$route}' failed");
        }
    }
}
