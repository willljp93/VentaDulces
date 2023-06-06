<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['image', 'max:2048'], // Cambiar el tamaño máximo según sea necesario
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile_photos', $fileName);
            $user->photo_path = 'http://localhost:8000/storage/profile_photos/' . $fileName;
        }

        $user->save();

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }


    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(['user' => $user]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|min:8',
            'photo' => 'nullable|image|max:2048',
            'rol' => 'sometimes|required|string',
        ]);
        if ($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('public');
        }
        $user->fill($validatedData);
        $user->save();
        return response()->json(['user' => $user]);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
