<?php

namespace App\Actions\Auth;

use App\Http\Requests\LoginPostRequest;

class AuthLoginAction
{
    /**
     * @param LoginPostRequest $request
     * @return void
     */
    public function __invoke(LoginPostRequest $request): void
    {
        $request->session()->regenerate();

    }
}
