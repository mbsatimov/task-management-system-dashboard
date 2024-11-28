<?php

namespace App\Http\Controllers;

use App\Actions\Permission\PermissionDestroyAction;
use App\Actions\Permission\PermissionGetAllAction;
use App\Actions\Permission\PermissionStoreAction;
use App\Actions\Permission\PermissionUpdateAction;
use App\Http\Requests\PermissionPostRequest;
use App\Http\Requests\PermissionPutRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request, PermissionGetAllAction $permissionGetAllAction): Response
    {
        $permissions = $permissionGetAllAction($request);
        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions,
            'searchTerm' => $request->search
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
