<?php

namespace App\Http\Controllers;

use App\Actions\PermissionGetPaginatedAction;
use App\Actions\RoleDestroyAction;
use App\Actions\RoleGetAllWithPermissionsAction;
use App\Actions\RoleGetWithPermissionsAction;
use App\Actions\RoleStoreAction;
use App\Actions\RoleUpdateAction;
use App\Http\Requests\RolePostRequest;
use App\Http\Requests\RolePutRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(RoleGetAllWithPermissionsAction $roleGetAllWithPermissionsAction): Response
    {
        $roles = $roleGetAllWithPermissionsAction();

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    public function store(RolePostRequest $request, RoleStoreAction $roleStoreAction): RedirectResponse
    {
        $validated = $request->validated();

        $roleStoreAction($validated);

        return redirect('roles')->with(['message' => 'Role created successfully!']);
    }

    public function create(PermissionGetPaginatedAction $permissionGetAllAction): Response
    {
        $permissions = $permissionGetAllAction();

        return Inertia::render('Roles/Create', [
            'permissions' => $permissions
        ]);
    }

    public function edit(Role $role, RoleGetWithPermissionsAction $roleGetWithPermissionAction, PermissionGetPaginatedAction $permissionGetAllAction): Response
    {
        $role = $roleGetWithPermissionAction($role);

        $permissions = $permissionGetAllAction();

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(RolePutRequest $request, Role $role, RoleUpdateAction $roleUpdateAction): RedirectResponse
    {
        $validated = $request->validated();
        $roleUpdateAction($role, $validated);

        return redirect('roles')->with(['message' => 'Role updated successfully!']);
    }

    public function destroy(Role $role, RoleDestroyAction $roleDestroyAction): RedirectResponse
    {
        $roleDestroyAction($role);

        return redirect('roles')->with(['message' => 'Role deleted successfully!']);
    }
}
