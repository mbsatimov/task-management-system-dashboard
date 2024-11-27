<?php

namespace App\Http\Controllers;

use App\Actions\GroupDestroyAction;
use App\Actions\GroupGetPaginatedWithUsersAction;
use App\Actions\GroupGetWithUsersAction;
use App\Actions\GroupStoreAction;
use App\Actions\GroupUpdateAction;
use App\Actions\UserGetPaginatedWithRolesAction;
use App\Http\Requests\GroupPostRequest;
use App\Http\Requests\GroupPutRequest;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function create(Request $request, UserGetPaginatedWithRolesAction $userGetPaginatedAction): Response
    {
        $users = $userGetPaginatedAction($request);

        return Inertia::render('Groups/Create', [
            'users' => $users,
            'searchTerm' => $request->search
        ]);
    }

    public function store(GroupPostRequest $request, GroupStoreAction $groupStoreAction): RedirectResponse
    {
        $validated = $request->validated();
        $groupStoreAction($validated);

        return redirect('groups')->with('message', 'Group created successfully');
    }

    public function edit(Request $request, Group $group, GroupGetWithUsersAction $groupGetWithUsersAction, UserGetPaginatedWithRolesAction $userGetPaginatedAction): Response
    {
        $group = $groupGetWithUsersAction($group);
        $users = $userGetPaginatedAction($request);

        return Inertia::render('Groups/Edit', [
            'group' => $group,
            'users' => $users,
            'searchTerm' => $request->search
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
