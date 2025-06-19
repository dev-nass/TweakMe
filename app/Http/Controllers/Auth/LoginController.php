<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Listenes to forms submit on
     * Login Form
     */
    public function store(Request $request)
    {

        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()->max(255)]
        ]);

        // will contain either 'email' or 'username'
        $loginCreds = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::attempt([$loginCreds => $request->login, 'password' => $request->password])) {
            throw ValidationException::withMessages([
                'login' => 'Sorry, those credentials does not match',
            ]);
        }

        $request->session()->regenerate();

        Auth::user()->update([
                'status' => 1,
                'last_seen' => now(),
            ]);

        return to_route('index');
    }

    /**
     * Sign out the user
     */
    public function destroy()
    {

        Auth::user()->update([
            'status' => 0,
        ]);

        Auth::logout();

        return to_route('index');
    }
}
