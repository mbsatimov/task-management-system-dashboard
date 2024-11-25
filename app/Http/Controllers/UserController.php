<?php

namespace App\Http\Controllers;

use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserPutRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::with('roles')->paginate(10);

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function store(UserPostRequest $request, StoreUserAction $storeUserAction): RedirectResponse
    {
        $validated = $request->validated();

        $storeUserAction($validated, $request->roles);

        return redirect('users')->with('message', 'User created successfully');
    }

    public function create(): Response
    {
        $roles = Role::get();

        return Inertia::render('Users/Create', [
            'roles' => $roles
        ]);
    }

    public function edit(User $user): Response
    {
        $user->load('roles');

        $roles = Role::get();

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(UserPutRequest $request, User $user, UpdateUserAction $updateUserAction): RedirectResponse
    {
        $validated = $request->validated();

        $updateUserAction($user, $validated, $request->roles);

        return redirect('users')->with('message', 'User updated successfully');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect('users')->with('message', 'User deleted successfully');
    }
}
