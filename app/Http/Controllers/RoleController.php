<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePostRequest;
use App\Http\Requests\RolePutRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): Response
    {
        $roles = Role::with('permissions')->get();

        return Inertia::render('Roles/Index', [
            'roles' => $roles,
        ]);
    }

    public function store(RolePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $role = Role::create($validated);

        $role->syncPermissions($request->permissions);

        return redirect('roles')->with(['message' => 'Role created successfully!', 'role' => $role]);
    }

    public function create(): Response
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return Inertia::render('Roles/Create', [
            'permissions' => $permissions
        ]);
    }

    public function edit(Role $role): Response
    {
        $role->load('permissions');

        $permissions = Permission::get();

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(RolePutRequest $request, Role $role): RedirectResponse
    {
        $validated = $request->validated();

        $role->update(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return redirect('roles')->with(['message' => 'Role updated successfully!', 'role' => $role]);
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect('roles')->with(['message' => 'Role deleted successfully!']);
    }
}
