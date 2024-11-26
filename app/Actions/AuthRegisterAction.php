<?php

namespace App\Actions;

use App\Http\Requests\RegisterPostRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRegisterAction
{
    public function __invoke(RegisterPostRequest $request): void
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

    }
}


