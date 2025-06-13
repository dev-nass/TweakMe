<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/registration', [
            'username' => 'JohnDoe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(302); // or assertRedirect(...)
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }
}
