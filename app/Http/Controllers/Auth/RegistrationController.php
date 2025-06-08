<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    //
    public function create()
    {
        return view('auth.registration');
    }

    /**
     * Listens for the form submit of
     * Registration form
    */
    public function store(Request $request)
    {

        $userAttributes = $request->validate([
            'username' => ['required', 'string', 'min:5', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()->max(255), 'confirmed']
        ]);

        User::create($userAttributes);

        return view('auth.login');

    }
}
