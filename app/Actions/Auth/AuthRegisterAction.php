<?php

namespace App\Actions\Auth;

use App\Http\Requests\RegisterPostRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRegisterAction
{
    /**
     * @param RegisterPostRequest $request
     * @return void
     */
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
