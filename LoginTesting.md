```php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_login_form()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_access_login_form_when_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('login'));
        $response->assertRedirect(route('index'));
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make($password = 'i-love-you123')
        ]);

        $response = $this->post(route('login-store'), [
            'login' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('i-love-you123')
        ]);

        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => $user->email,
            'password' => 'wrong-password'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertTrue(session()->hasOldInput('login'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    // Additional test suggestions:

    public function test_user_cannot_login_with_nonexistent_email()
    {
        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => 'nonexistent@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    public function test_login_requires_email_field()
    {
        $response = $this->from(route('login'))->post(route('login-store'), [
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    public function test_login_requires_password_field()
    {
        $user = User::factory()->create();

        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => $user->email
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_login_validates_email_format()
    {
        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => 'invalid-email-format',
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    public function test_login_with_empty_credentials()
    {
        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => '',
            'password' => ''
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors(['login', 'password']);
        $this->assertGuest();
    }

    public function test_login_trims_whitespace_from_email()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password = 'password123')
        ]);

        $response = $this->post(route('login-store'), [
            'login' => '  test@example.com  ',
            'password' => $password
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_is_case_insensitive_for_email()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password = 'password123')
        ]);

        $response = $this->post(route('login-store'), [
            'login' => 'TEST@EXAMPLE.COM',
            'password' => $password
        ]);

        // This test assumes your login handles case-insensitive emails
        // Remove if your app is case-sensitive
        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_login_with_username_instead_of_email()
    {
        // Only include this if your app supports username login
        $user = User::factory()->create([
            'username' => 'johndoe',
            'password' => Hash::make($password = 'password123')
        ]);

        $response = $this->post(route('login-store'), [
            'login' => 'johndoe',
            'password' => $password
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_inactive_user_cannot_login()
    {
        // Only include if your app has user status/active field
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password = 'password123'),
            'is_active' => false
        ]);

        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    public function test_unverified_user_cannot_login()
    {
        // Only include if your app requires email verification
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password = 'password123'),
            'email_verified_at' => null
        ]);

        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect(route('email.verify'));
        $this->assertGuest();
    }

    public function test_login_rate_limiting()
    {
        // Test rate limiting - adjust attempts based on your app's config
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('correct-password')
        ]);

        // Make several failed attempts
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('login-store'), [
                'login' => $user->email,
                'password' => 'wrong-password'
            ]);
        }

        // Next attempt should be rate limited
        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => $user->email,
            'password' => 'wrong-password'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        // Check if the error message contains rate limiting info
        $this->assertStringContainsString('too many', session('errors')->first('login'));
    }

    public function test_successful_login_clears_rate_limiting()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password = 'correct-password')
        ]);

        // Make some failed attempts
        for ($i = 0; $i < 3; $i++) {
            $this->post(route('login-store'), [
                'login' => $user->email,
                'password' => 'wrong-password'
            ]);
        }

        // Successful login should clear rate limiting
        $response = $this->post(route('login-store'), [
            'login' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_remember_me_functionality()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password = 'password123')
        ]);

        $response = $this->post(route('login-store'), [
            'login' => $user->email,
            'password' => $password,
            'remember' => true
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
        
        // Check if remember token is set
        $this->assertNotNull($user->fresh()->remember_token);
    }

    public function test_login_redirects_to_intended_url()
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'password123')
        ]);

        // Try to access a protected route
        $this->get(route('profile'))->assertRedirect(route('login'));

        // Login and check if redirected to intended URL
        $response = $this->post(route('login-store'), [
            'login' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect(route('profile'));
    }

    protected function tearDown(): void
    {
        // Clear rate limiting after each test
        RateLimiter::clear('login');
        parent::tearDown();
    }
}

```