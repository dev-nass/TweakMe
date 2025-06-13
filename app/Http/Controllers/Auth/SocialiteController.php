<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialiteController extends Controller
{

    /**
     * Function: googleLogin
     * Definition: allows user to login using gmail account
     * @param
     * @return
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }


    //
    public function googleAuthentication()
    {

        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', '=', $googleUser->id)->first();

            if (! $user) {
                $userData = User::create([
                    'username' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                ]);
            }

            $user ? Auth::login($user) : Auth::login($userData);

            return to_route('index');
        } catch (Throwable $e) {
            dd($e);
        }
    }

    
}
