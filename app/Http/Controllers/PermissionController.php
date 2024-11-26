<?php

namespace App\Http\Controllers;

use App\Actions\PermissionDestroyAction;
use App\Actions\PermissionGetAllAction;
use App\Actions\PermissionStoreAction;
use App\Actions\PermissionUpdateAction;
use App\Http\Requests\PermissionPostRequest;
use App\Http\Requests\PermissionPutRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(PermissionGetAllAction $permissionGetAllAction): Response
    {
        $permissions = $permissionGetAllAction();
        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions
        ]);
    }

    public function store(PermissionPostRequest $request, PermissionStoreAction $permissionStoreAction): RedirectResponse
    {
        $validated = $request->validated();

        $permissionStoreAction($validated);

        return redirect('permissions')->with('message', 'Permission created successfully');
    }

    public function create(): Response
    {
        return Inertia::render('Permissions/Create');
    }

    public function edit(Permission $permission): Response
    {
        return Inertia::render('Permissions/Edit', [
            'permission' => $permission
        ]);
    }

    public function update(PermissionPutRequest $request, Permission $permission, PermissionUpdateAction $permissionUpdateAction): RedirectResponse
    {
        $validated = $request->validated();

        $permissionUpdateAction($permission, $validated);

        return redirect('permissions')->with('message', 'Permission updated successfully');
    }

    public function destroy(Permission $permission, PermissionDestroyAction $permissionDestroyAction): RedirectResponse
    {
        $permissionDestroyAction($permission);
        return redirect('permissions')->with('message', 'Permission deleted successfully');
    }
}
