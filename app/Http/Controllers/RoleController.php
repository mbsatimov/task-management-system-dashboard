<?php

namespace App\Http\Controllers;

use App\Actions\Permission\TaskCategoryGetAllAction;
use App\Actions\Role\RoleDestroyAction;
use App\Actions\Role\RoleGetAllWithPermissionsAction;
use App\Actions\Role\RoleGetWithPermissionsAction;
use App\Actions\Role\RoleStoreAction;
use App\Actions\Role\RoleUpdateAction;
use App\Http\Requests\RolePostRequest;
use App\Http\Requests\RolePutRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function create(Request $request, TaskCategoryGetAllAction $permissionGetAllAction): Response
    {
        $permissions = $permissionGetAllAction($request);

        return Inertia::render('Roles/Create', [
            'permissions' => $permissions
        ]);
    }

    public function edit(Request $request, Role $role, RoleGetWithPermissionsAction $roleGetWithPermissionAction, TaskCategoryGetAllAction $permissionGetAllAction): Response
    {
        $role = $roleGetWithPermissionAction($role);

        $permissions = $permissionGetAllAction($request);

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
