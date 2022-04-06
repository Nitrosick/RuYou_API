<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['name'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Incorrect Login or Password',
                'result' => Hash::check($fields['password'], $user->password)
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function get_user_info() {
        return response([
            'user' => auth()->user()
        ], 201);
    }

    public function edit_user_info(Request $request) {

        // Phone validation

        $fields = $request->validate([
            'name' => 'required|string|min:3',
            'surname' => 'required|string|min:3',
            'phone' => 'required|string|min:11|max:11'
        ]);

        auth()->user()->update([
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'phone' => $fields['phone']
        ]);

        return response([
            'message' => 'User info edited'
        ], 201);
    }
}
