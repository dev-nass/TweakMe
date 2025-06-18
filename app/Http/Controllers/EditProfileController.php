<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

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

        $validatedAtrr = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'description' => ['string', 'max:255']
        ]);

        $user->update($validatedAtrr);

        if ($request->hasFile('profile')) {
            $attachment = $request->validate([
                'profile' => [File::types(['png', 'jpg', 'webp'])]
            ]);

            $path = $attachment['profile']->store('images/profiles', 'public');

            $user->update([
                'profile' => $path,
            ]);
        }

        return back();
    }
}
