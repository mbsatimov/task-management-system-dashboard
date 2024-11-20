<?php

namespace App\Http\Controllers;

use App\Actions\RecordUserLoginAction;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class AuthController extends Controller
{
    public function index(): Response {
        return inertia('Auth/Login');
    }

    public function login(LoginPostRequest $request, RecordUserLoginAction $recordLogin): RedirectResponse {
        $fields = $request->validated();

        if (!Auth::attempt($fields, $request->remember)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }

        $recordLogin($request);

        return redirect()->route('dashboard')->with('greet', 'Welcome back to Laravel Inertia Vue!');
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}

