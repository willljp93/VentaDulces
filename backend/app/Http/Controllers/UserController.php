<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->all();
        return response()->json(['users' => $users]);
    }

    public function store(StoreUserRequest $request)
    {
        $photo_path = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile_photos', $fileName);
            $photo_path = Storage::url('profile_photos/' . $fileName);
        }

        $user = $this->user->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'photo' => $photo_path,
            'rol' => $request->input('rol')
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function show(User $user)
    {
        return response()->json(['user' => $user]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            "photo" => 'image'
        ]);
        $user = User::findorfail($request->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->name = $request->input('name');
        $user->email = $request->email;
        /*if ($request->input('password')) {
            $user->password = Hash::make($request->password);
        }*/
        $user->rol = $request->rol;
        if ($user->photo == $request->photo) {
            $user->save();
        } else {
            if ($request->hasFile('photo')) {
                if ($user->photo && Storage::exists('public/profile_photos/' . basename($user->photo))) {
                    Storage::delete('public/profile_photos/' . basename($user->photo));
                }
                $photo = $request->file('photo');


                $fileName = uniqid() . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('public/profile_photos', $fileName);
                $user->photo = Storage::url('http://localhost:8000/storage/profile_photos' . $fileName);
            }
            $user->save();
        }



        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);
    }

    public function destroy(User $id)
    {
        // if (!$user) {
        //     return response()->json(['error' => 'User not found'], 404);
        // }
        if ($id->photo && Storage::exists('public/profile_photos/' . basename($id->photo))) {
            Storage::delete('public/profile_photos/' . basename($id->photo));
        }

        $id->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
