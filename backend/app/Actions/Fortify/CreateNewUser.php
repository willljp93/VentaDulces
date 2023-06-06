<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Http\Request;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \Illuminate\Foundation\Auth\User
     */
    public function create(array $input)
    {
        $request = app(Request::class);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'photo' => ['nullable', 'image', Rule::dimensions()->maxWidth(1000)->maxHeight(1000), 'max:2048'],
            'rol' => 'nullable|string'
        ])->validate();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile_photos', $fileName);
            $photo_path = 'http://localhost:8000/storage/profile_photos/' . $fileName;
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'photo' => $photo_path ?? null,
            'rol' => $input['rol']
        ]);

        event(new Registered($user));

        return $user;
    }
}
