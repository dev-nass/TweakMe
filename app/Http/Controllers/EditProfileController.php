<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{

    /**
     * @return: view
    */
    public function edit(User $user)
    {
        return view('editProfile.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {

        dd($request->all());
    }
}
