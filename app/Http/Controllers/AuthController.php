<?php

namespace App\Http\Controllers;

use App\Actions\AuthLoginAction;
use App\Actions\AuthRegisterAction;
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


    public function register(RegisterPostRequest $request, AuthRegisterAction $registerAction): RedirectResponse
    {
        $request->validated();

        $registerAction($request);

        return redirect('/')->with('message', 'You have successfully registered!');
    }

    public function login(LoginPostRequest $request, AuthLoginAction $loginAction): RedirectResponse
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated, $request->remember)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }

        $loginAction($request);

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

