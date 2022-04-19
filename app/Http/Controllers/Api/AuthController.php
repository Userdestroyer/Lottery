<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function register (Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'user'
        ]);
        $user->payAccount()->create(['balance' => '0']);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout (Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out',
        ];
    }

    public function login (Request $request) {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)){
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password']
            ]);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'message' => 'Logged in',
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
