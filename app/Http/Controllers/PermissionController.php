<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionPostRequest;
use App\Http\Requests\PermissionPutRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): Response
    {
        $permissions = Permission::get();
        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions
        ]);
    }

    public function store(PermissionPostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Permission::create($validated);

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

    public function update(PermissionPutRequest $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validated();

        $permission->update($validated);

        return redirect('permissions')->with('message', 'Permission updated successfully');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return redirect('permissions')->with('message', 'Permission deleted successfully');
    }
}
