<?php

namespace App\Actions;

use App\Http\Requests\LoginPostRequest;

class AuthLoginAction
{
    public function __invoke(LoginPostRequest $request): void
    {
        $request->session()->regenerate();

    }
}


