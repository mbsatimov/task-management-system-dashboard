<?php

namespace App\Http\Controllers;

use App\Actions\Permission\PermissionDestroyAction;
use App\Actions\Permission\PermissionGetAllAction;
use App\Actions\Permission\PermissionStoreAction;
use App\Actions\Permission\PermissionUpdateAction;
use App\Http\Requests\PermissionGetAllRequest;
use App\Http\Requests\PermissionPostRequest;
use App\Http\Requests\PermissionPutRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * @param PermissionGetAllRequest $request
     * @param PermissionGetAllAction $permissionGetAllAction
     * @return Response
     */
    public function index(PermissionGetAllRequest $request, PermissionGetAllAction $permissionGetAllAction): Response
    {
        $permissions = $permissionGetAllAction($request);

        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param PermissionPostRequest $request
     * @param PermissionStoreAction $permissionStoreAction
     * @return RedirectResponse
     */
    public function store(
        PermissionPostRequest $request,
        PermissionStoreAction $permissionStoreAction
    ): RedirectResponse {
        $validated = $request->validated();
        $permissionStoreAction($validated);

        return redirect('permissions')->with('message', 'Permission created successfully');
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Permissions/Create');
    }

    /**
     * @param Permission $permission
     * @return Response
     */
    public function edit(Permission $permission): Response
    {
        return Inertia::render('Permissions/Edit', [
            'permission' => $permission
        ]);
    }

    /**
     * @param PermissionPutRequest $request
     * @param Permission $permission
     * @param PermissionUpdateAction $permissionUpdateAction
     * @return RedirectResponse
     */
    public function update(
        PermissionPutRequest $request,
        Permission $permission,
        PermissionUpdateAction $permissionUpdateAction
    ): RedirectResponse {
        $validated = $request->validated();
        $permissionUpdateAction($permission, $validated);

        return redirect('permissions')->with('message', 'Permission updated successfully');
    }

    /**
     * @param Permission $permission
     * @param PermissionDestroyAction $permissionDestroyAction
     * @return RedirectResponse
     */
    public function destroy(
        Permission $permission,
        PermissionDestroyAction $permissionDestroyAction
    ): RedirectResponse {
        $permissionDestroyAction($permission);

        return redirect('permissions')->with('message', 'Permission deleted successfully');
    }
}
