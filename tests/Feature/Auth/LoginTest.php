<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


/**
 * Things that could be added
 *  - test_inactive_user_cannot_login
 *  - test_unverified_user_cannot_login
 *  - test_login_rate_limiting
 *  - test_successful_login_clears_rate_limiting
 *  - test_remember_me_functionality
*/

class LoginTest extends TestCase
{

    // runs the migrations behind the scene every test
    use RefreshDatabase;

    public function test_user_can_view_login_form()
    {

        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }


    public function test_user_can_login_with_correct_credentials()
    {

        // password has to be declared in here and passed later because 
        // $user doesn't have access to the $user->password
        $user = User::factory()->create([
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt($password = 'i-love-you123')
        ]);

        $response = $this->post(route('login-store'), [
            'login' => $user->email,
            'password' => $password
        ]);

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }


    /**
     * Checks if authenticated user logout
     */
    public function test_user_can_logout_when_authenticated()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }


    public function test_user_requires_email_field()
    {

        $response = $this->from(route('login'))->post(route('login-store'), [
            'password' => 'faker123',
        ]);

        $response->isRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }


    public function test_user_requires_password_field()
    {

        $response = $this->from(route('login'))->post(route('login-store'), [
            'email' => 'faker@gmail.com',
        ]);

        $response->isRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }


    public function test_user_cannot_access_login_form_when_authenticated()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect(route('index'));
    }



    public function test_user_cannot_login_with_nonexistent_email()
    {

        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => 'faker@gmail.com',
            'password' => 'faker123'
        ]);

        $response->isRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }



    public function test_user_cannot_login_with_incorrect_password()
    {

        $user = User::factory()->create([
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('i-love-you123')
        ]);

        $response = $this->from(route('login'))->post(route('login-store'), [
            'login' => $user->email,
            'password' => 'i-love-you-456'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('login');
        $this->assertTrue(session()->hasOldInput('login'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }


    /**
     * Testing if a user can access the logout route, 
     * even if they are not log-in
     */
    public function test_user_cannot_logout_when_guest()
    {

        // you can also send CSRF TOKEN through this
        // $response = $this->withHeaders([
        //     'X-CSRF-TOKEN' => csrf_token(),
        // ])->delete(route('logout'));

        // $response->assertRedirect(route('login'));
        // $this->assertGuest();


        $response = $this->delete(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
