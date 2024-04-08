<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $registerUserData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => $registerUserData['password'],
        ]);

        if (!$user->save()) {
            return response()->json(
                ['error' => 'Unable to register'],
                400
            );
        }

        $token = $user
            ->createToken('Personal Access Token')->plainTextToken;

        return response()->json(
            [
                'message' => 'Successfully created user!',
                'accessToken' => $token,
            ],
            201
        );
    }
    public function login(Request $request)
    {
        $loginUserData = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($loginUserData)) {
            return response()->json(
                ['message' => 'Unable to auth'],
                400
            );
        }

        $token = Auth::user()
            ->createToken('Personal Access Token')
            ->plainTextToken;
        return response()->json(
            [
                'accessToken' => $token,
                'token_type' => 'Bearer',
            ],
            200
        );
    }
}
