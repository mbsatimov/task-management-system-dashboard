<?php

namespace App\Http\Controllers;

use App\Actions\Role\RoleGetAllAction;
use App\Actions\User\UserDestroyAction;
use App\Actions\User\UserGetPaginatedWithRolesAction;
use App\Actions\User\UserGetWithRolesAction;
use App\Actions\User\UserStoreAction;
use App\Actions\User\UserUpdateAction;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserPutRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request, UserGetPaginatedWithRolesAction $userGetPaginatedWithRolesAction): Response
    {
        $users = $userGetPaginatedWithRolesAction($request);

        return Inertia::render('Users/Index', [
            'users' => $users,
            'searchTerm' => $request->search
        ]);
    }

    public function store(UserPostRequest $request, UserStoreAction $userStoreAction): RedirectResponse
    {
        $validated = $request->validated();
        $userStoreAction($validated);

        return redirect('users')->with('message', 'User created successfully');
    }

    public function create(RoleGetAllAction $roleGetAllAction): Response
    {
        $roles = $roleGetAllAction();

        return Inertia::render('Users/Create', [
            'roles' => $roles
        ]);
    }

    public function edit(User $user, UserGetWithRolesAction $userWithRolesAction, RoleGetAllAction $roleGetAllAction): Response
    {
        $user = $userWithRolesAction($user);
        $roles = $roleGetAllAction();

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(UserPutRequest $request, User $user, UserUpdateAction $userUpdateAction): RedirectResponse
    {
        $validated = $request->validated();
        $userUpdateAction($user, $validated);

        return redirect('users')->with('message', 'User updated successfully');
    }

    public function destroy(User $user, UserDestroyAction $userDestroyAction): RedirectResponse
    {
        $userDestroyAction($user);

        return redirect('users')->with('message', 'User deleted successfully');
    }
}
