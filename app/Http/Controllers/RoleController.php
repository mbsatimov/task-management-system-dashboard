<?php

namespace App\Http\Controllers;

use App\Actions\Permission\PermissionGetAllAction;
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
    /**
     * @param RoleGetAllWithPermissionsAction $roleGetAllWithPermissionsAction
     * @return Response
     */
    public function index(RoleGetAllWithPermissionsAction $roleGetAllWithPermissionsAction): Response
    {
        $roles = $roleGetAllWithPermissionsAction();

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    /**
     * @param RolePostRequest $request
     * @param RoleStoreAction $roleStoreAction
     * @return RedirectResponse
     */
    public function store(RolePostRequest $request, RoleStoreAction $roleStoreAction): RedirectResponse
    {
        $validated = $request->validated();
        $roleStoreAction($validated);

        return redirect('roles')->with(['message' => 'Role created successfully!']);
    }

    /**
     * @param Request $request
     * @param PermissionGetAllAction $permissionGetAllAction
     * @return Response
     */
    public function create(Request $request, PermissionGetAllAction $permissionGetAllAction): Response
    {
        $permissions = $permissionGetAllAction($request);

        return Inertia::render('Roles/Create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * @param Request $request
     * @param Role $role
     * @param RoleGetWithPermissionsAction $roleGetWithPermissionAction
     * @param PermissionGetAllAction $permissionGetAllAction
     * @return Response
     */
    public function edit(Request $request, Role $role, RoleGetWithPermissionsAction $roleGetWithPermissionAction, PermissionGetAllAction $permissionGetAllAction): Response
    {
        $role = $roleGetWithPermissionAction($role);
        $permissions = $permissionGetAllAction($request);

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * @param RolePutRequest $request
     * @param Role $role
     * @param RoleUpdateAction $roleUpdateAction
     * @return RedirectResponse
     */
    public function update(RolePutRequest $request, Role $role, RoleUpdateAction $roleUpdateAction): RedirectResponse
    {
        $validated = $request->validated();
        $roleUpdateAction($role, $validated);

        return redirect('roles')->with(['message' => 'Role updated successfully!']);
    }

    /**
     * @param Role $role
     * @param RoleDestroyAction $roleDestroyAction
     * @return RedirectResponse
     */
    public function destroy(Role $role, RoleDestroyAction $roleDestroyAction): RedirectResponse
    {
        $roleDestroyAction($role);

        return redirect('roles')->with(['message' => 'Role deleted successfully!']);
    }
}
