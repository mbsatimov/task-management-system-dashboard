<?php

namespace App\Http\Controllers;

use App\Actions\RecordUserLoginAction;
use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\RegisterPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class AuthController extends Controller
{
    public function registerPage(): Response {
        return inertia('Auth/Register');
    }

    public function loginPage(): Response {
        return inertia('Auth/Login');
    }


    public function register(RegisterPostRequest $request): RedirectResponse {

        $validated = $request->validated();

        $user = User::create($validated);

        $user->assignRole('admin');

        Auth::login($user);

        return redirect('/')->with('message', 'You have successfully registered!');
    }

    public function login(LoginPostRequest $request, RecordUserLoginAction $recordLogin): RedirectResponse {
        $fields = $request->validated();

        if (!Auth::attempt($fields, $request->remember)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }

        $recordLogin($request);

        return redirect('/')->with('message', 'You have successfully logged in!');
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

