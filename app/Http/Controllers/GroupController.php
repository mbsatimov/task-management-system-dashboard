<?php

namespace App\Http\Controllers;

use App\Actions\GroupDestroyAction;
use App\Actions\GroupGetPaginatedWithUsersAction;
use App\Actions\GroupGetWithPaginatedUsersAction;
use App\Actions\GroupStoreAction;
use App\Actions\GroupUpdateAction;
use App\Actions\UserGetPaginatedWithRolesAction;
use App\Http\Requests\GroupPostRequest;
use App\Http\Requests\GroupPutRequest;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class GroupController
{
    public function index(GroupGetPaginatedWithUsersAction $groupGetPaginatedAction): Response
    {
        $groups = $groupGetPaginatedAction();
        return Inertia::render('Groups/Index', [
            'groups' => $groups
        ]);
    }

    public function show(Group $group, GroupGetWithPaginatedUsersAction $groupGetWithPaginatedUsersAction): Response
    {
        $group = $groupGetWithPaginatedUsersAction($group);

        return Inertia::render('Groups/Show', [
            'group' => $group
        ]);
    }

    public function create(UserGetPaginatedWithRolesAction $userGetPaginatedAction): Response
    {
        $users = $userGetPaginatedAction();

        return Inertia::render('Groups/Create', [
            'users' => $users
        ]);
    }

    public function store(GroupPostRequest $request, GroupStoreAction $groupStoreAction): RedirectResponse
    {
        $validated = $request->validated();
        $groupStoreAction($validated);

        return redirect('groups')->with('message', 'Group created successfully');
    }

    public function edit(Group $group, GroupGetWithPaginatedUsersAction $groupGetWithPaginatedUsersAction, UserGetPaginatedWithRolesAction $userGetPaginatedAction): Response
    {
        $group = $groupGetWithPaginatedUsersAction($group);
        $users = $userGetPaginatedAction();

        return Inertia::render('Groups/Edit', [
            'group' => $group,
            'users' => $users
        ]);
    }

    public function update(GroupPutRequest $request, Group $group, GroupUpdateAction $groupUpdateAction)
    {
        $validated = $request->validated();
        $groupUpdateAction($group, $validated);

        return redirect('groups')->with('message', 'Group updated successfully');
    }

    public function destroy(Group $group, GroupDestroyAction $groupDestroyAction): RedirectResponse
    {
        $groupDestroyAction($group);

        return redirect('groups')->with('message', 'Group deleted successfully');
    }
}
