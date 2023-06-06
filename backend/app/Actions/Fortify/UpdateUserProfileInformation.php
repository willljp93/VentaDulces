<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Agregar validación para 'photo'
            'rol' => 'nullable|string'
        ])->validateWithBag('updateProfileInformation');

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'photo' => $input['photo'], // Asignar el valor del campo 'photo'
                'rol' => $input['rol'] // Asignar el valor del campo 'rol'
            ])->save();
        }

        // Si se actualizó el campo 'photo', eliminar la imagen anterior
        if (isset($input['photo']) && $user->getOriginal('photo') !== $input['photo']) {
            Storage::delete($user->getOriginal('photo'));
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'photo' => $input['photo'], // Asignar el valor del campo 'photo'
            'rol' => $input['rol'] // Asignar el valor del campo 'rol'
        ])->save();

        $user->sendEmailVerificationNotification();

        // Si se actualizó el campo 'photo', eliminar la imagen anterior
        if (isset($input['photo']) && $user->getOriginal('photo') !== $input['photo']) {
            Storage::delete($user->getOriginal('photo'));
        }
    }
}
