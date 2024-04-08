<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(
        RegisterUserRequest $request,
        UserService $userService
    ) {
        if (!$userService->register($request->getDTO())) {
            return response()->json(
                ['error' => 'Unable to register'],
                400
            );
        }
        $token = Auth::user()->getToken();
        return response()->json(
            [
                'message' => 'Successfully created user!',
                'accessToken' => $token,
            ],
            201
        );
    }
    public function login(
        LoginUserRequest $request,
        UserService $userService
    ) {
        if (!$userService->login($request->getDTO())) {
            return response()->json(
                ['message' => 'Unable to login'],
                400
            );
        }
        $token = Auth::user()
            ->createToken()
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
