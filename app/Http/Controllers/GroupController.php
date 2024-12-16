<?php

namespace App\Http\Controllers;

use App\Actions\Group\GroupDestroyAction;
use App\Actions\Group\GroupGetAction;
use App\Actions\Group\GroupGetPaginatedAction;
use App\Actions\Group\GroupStoreAction;
use App\Actions\Group\GroupUpdateAction;
use App\Actions\User\UserGetPaginatedAction;
use App\Http\Requests\GroupGetPaginatedRequest;
use App\Http\Requests\GroupPostRequest;
use App\Http\Requests\GroupPutRequest;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GroupController
{
    /**
     * @param GroupGetPaginatedRequest $request
     * @param GroupGetPaginatedAction $groupGetPaginatedAction
     * @return Response
     */
    public function index(GroupGetPaginatedRequest $request, GroupGetPaginatedAction $groupGetPaginatedAction): Response
    {
        $groups = $groupGetPaginatedAction($request);

        return Inertia::render('Groups/Index', [
            'groups' => $groups,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param Request $request
     * @param UserGetPaginatedAction $userGetPaginatedAction
     * @return Response
     */
    public function create(Request $request, UserGetPaginatedAction $userGetPaginatedAction): Response
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
     * @param GroupGetAction $groupGetAction
     * @param UserGetPaginatedAction $userGetPaginatedAction
     * @return Response
     */
    public function edit(
        Request                $request,
        Group                  $group,
        GroupGetAction         $groupGetAction,
        UserGetPaginatedAction $userGetPaginatedAction
    ): Response {
        $group = $groupGetAction($group);
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
     * @return RedirectResponse
     */
    public function update(
        GroupPutRequest     $request,
        Group               $group,
        GroupUpdateAction   $groupUpdateAction
    ): RedirectResponse {
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
