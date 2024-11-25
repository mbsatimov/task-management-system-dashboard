<?php

namespace App\Actions;

use App\Http\Requests\LoginPostRequest;

class RecordUserLoginAction
{
    public function __invoke(LoginPostRequest $request): void
    {
        $request->session()->regenerate();

    }
}


