<?php

namespace App\Http\Controllers;

use App\Actions\Role\RoleGetAllAction;
use App\Actions\TaskCategory\TaskCategoryGetAllAction;
use App\Actions\User\UserDestroyAction;
use App\Actions\User\UserGetAction;
use App\Actions\User\UserGetPaginatedAction;
use App\Actions\User\UserStoreAction;
use App\Actions\User\UserUpdateAction;
use App\Http\Requests\UserGetPaginatedRequest;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserPutRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * @param UserGetPaginatedRequest $request
     * @param UserGetPaginatedAction $userGetPaginatedWithRolesAction
     * @return Response
     */
    public function index(
        UserGetPaginatedRequest     $request,
        UserGetPaginatedAction      $userGetPaginatedWithRolesAction
    ): Response {
        $request->validated();
        $users = $userGetPaginatedWithRolesAction($request);

        return Inertia::render('Users/Index', [
            'users' => $users,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param UserPostRequest $request
     * @param UserStoreAction $userStoreAction
     * @return RedirectResponse
     */
    public function store(UserPostRequest $request, UserStoreAction $userStoreAction): RedirectResponse
    {
        $validated = $request->validated();
        $userStoreAction($validated);

        return redirect('users')->with('message', 'User created successfully');
    }

    /**
     * @param Request $request
     * @param RoleGetAllAction $roleGetAllAction
     * @param TaskCategoryGetAllAction $taskCategoryGetAllAction
     * @return Response
     */
    public function create(
        Request                  $request,
        RoleGetAllAction         $roleGetAllAction,
        TaskCategoryGetAllAction $taskCategoryGetAllAction
    ): Response {
        $roles = $roleGetAllAction();
        $categories = $taskCategoryGetAllAction($request);

        return Inertia::render('Users/Create', [
            'roles' => $roles,
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @param UserGetAction $userGetAction
     * @param RoleGetAllAction $roleGetAllAction
     * @param TaskCategoryGetAllAction $taskCategoryGetAllAction
     * @return Response
     */
    public function edit(
        Request                  $request,
        User                     $user,
        UserGetAction            $userGetAction,
        RoleGetAllAction         $roleGetAllAction,
        TaskCategoryGetAllAction $taskCategoryGetAllAction,
    ): Response {
        $user = $userGetAction($user);
        $roles = $roleGetAllAction();
        $categories = $taskCategoryGetAllAction($request);

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles,
            'categories' => $categories
        ]);
    }

    /**
     * @param UserPutRequest $request
     * @param User $user
     * @param UserUpdateAction $userUpdateAction
     * @return RedirectResponse
     */
    public function update(
        UserPutRequest   $request,
        User             $user,
        UserUpdateAction $userUpdateAction
    ): RedirectResponse {
        $validated = $request->validated();
        $userUpdateAction($user, $validated);

        return redirect('users')->with('message', 'User updated successfully');
    }

    /**
     * @param User $user
     * @param UserDestroyAction $userDestroyAction
     * @return RedirectResponse
     */
    public function destroy(User $user, UserDestroyAction $userDestroyAction): RedirectResponse
    {
        $userDestroyAction($user);

        return redirect('users')->with('message', 'User deleted successfully');
    }
}
