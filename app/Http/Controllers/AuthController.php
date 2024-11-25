<?php

namespace App\Http\Controllers;

use App\Actions\RecordUserLoginAction;
use App\Actions\RecordUserRegisterAction;
use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\RegisterPostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class AuthController extends Controller
{
    public function registerPage(): Response
    {
        return inertia('Auth/Register');
    }

    public function loginPage(): Response
    {
        return inertia('Auth/Login');
    }


    public function register(RegisterPostRequest $request, RecordUserRegisterAction $recordRegister): RedirectResponse
    {
        $request->validated();

        $recordRegister($request);

        return redirect('/')->with('message', 'You have successfully registered!');
    }

    public function login(LoginPostRequest $request, RecordUserLoginAction $recordLogin): RedirectResponse
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated, $request->remember)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }

        $recordLogin($request);

        return redirect('/')->with('message', 'You have successfully logged in!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

