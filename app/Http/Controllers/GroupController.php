<?php

namespace App\Http\Controllers;

use App\Actions\Group\GroupDestroyAction;
use App\Actions\Group\GroupGetPaginatedWithUsersAction;
use App\Actions\Group\GroupGetWithUsersAction;
use App\Actions\Group\GroupStoreAction;
use App\Actions\Group\GroupUpdateAction;
use App\Actions\User\UserGetPaginatedWithRolesAction;
use App\Http\Requests\GroupPostRequest;
use App\Http\Requests\GroupPutRequest;
use App\Models\Group;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class GroupController
{
    /**
     * @param GroupGetPaginatedWithUsersAction $groupGetPaginatedAction
     * @return Response
     */
    public function index(GroupGetPaginatedWithUsersAction $groupGetPaginatedAction): Response
    {
        $groups = $groupGetPaginatedAction();

        return Inertia::render('Groups/Index', [
            'groups' => $groups
        ]);
    }

    /**
     * @param Request $request
     * @param UserGetPaginatedWithRolesAction $userGetPaginatedAction
     * @return Response
     */
    public function create(Request $request, UserGetPaginatedWithRolesAction $userGetPaginatedAction): Response
    {
        $users = $userGetPaginatedAction($request);

        return Inertia::render('Groups/Create', [
            'users' => $users,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param GroupPostRequest $request
     * @param GroupStoreAction $groupStoreAction
     * @return RedirectResponse
     */
    public function store(GroupPostRequest $request, GroupStoreAction $groupStoreAction): RedirectResponse
    {
        $validated = $request->validated();
        $groupStoreAction($validated);

        return redirect('groups')->with('message', 'Group created successfully');
    }

    /**
     * @param Request $request
     * @param Group $group
     * @param GroupGetWithUsersAction $groupGetWithUsersAction
     * @param UserGetPaginatedWithRolesAction $userGetPaginatedAction
     * @return Response
     */
    public function edit(
        Request $request,
        Group $group,
        GroupGetWithUsersAction $groupGetWithUsersAction,
        UserGetPaginatedWithRolesAction $userGetPaginatedAction
    ): Response {
        $group = $groupGetWithUsersAction($group);
        $users = $userGetPaginatedAction($request);

        return Inertia::render('Groups/Edit', [
            'group' => $group,
            'users' => $users,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param GroupPutRequest $request
     * @param Group $group
     * @param GroupUpdateAction $groupUpdateAction
     * @return Application|RedirectResponse|Redirector
     */
    public function update(GroupPutRequest $request, Group $group, GroupUpdateAction $groupUpdateAction)
    {
        $validated = $request->validated();
        $groupUpdateAction($group, $validated);

        return redirect('groups')->with('message', 'Group updated successfully');
    }

    /**
     * @param Group $group
     * @param GroupDestroyAction $groupDestroyAction
     * @return RedirectResponse
     */
    public function destroy(Group $group, GroupDestroyAction $groupDestroyAction): RedirectResponse
    {
        $groupDestroyAction($group);

        return redirect('groups')->with('message', 'Group deleted successfully');
    }
}
