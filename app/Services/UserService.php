<?php

namespace App\Services;

use App\DTO\User\LoginUserDTO;
use App\DTO\User\RegisterUserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class UserService
{
    public function register(
        RegisterUserDTO $request,
    ): bool {

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if (!$user->save()) {
            return false;
        }

        Auth::login($user);
        return true;
    }
    public function login(
        LoginUserDTO $request
    ): bool {
        return Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
    }
}
