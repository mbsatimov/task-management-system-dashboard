<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): \Inertia\Response
    {
        $users = User::with('roles')->paginate(10); // Use pagination for large datasets

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function create(): Response {
        return Inertia::render('Users/Create');
    }

    public function store(UserPostRequest $request): RedirectResponse {
        $validated = $request->validated();

        $user = User::create($validated);

        return redirect('users')->with('message', 'User created successfully');
    }

    public function edit(User $user): Response {
        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    }

    public function update(UserPutRequest $request, User $user): RedirectResponse {
        $validated = $request->validated();

        $user->update($validated);

        return redirect('users')->with('message', 'User updated successfully');
    }

    public function destroy(User $user): RedirectResponse {
        $user->delete();
        return redirect('users')->with('message', 'User deleted successfully');
    }
}
