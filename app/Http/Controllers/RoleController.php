<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePostRequest;
use App\Http\Requests\RolePutRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Roles/Page', [
            'roles' => Role::all(),
        ]);
    }

    public function store(RolePostRequest $request): RedirectResponse   {
        $validated = $request->validated();

        $role = Role::create($validated);

        return back()->with(['message' => 'Role created successfully!', 'role' => $role]);
    }

    public function update(RolePutRequest $request, int $id): RedirectResponse {
        $validated = $request->validated();

        $role = Role::find($id);

        if (!$role) {
            return back()->withErrors(['message' => 'Role not found!'], 404);
        }

        $role->update($validated);

        return back()->with(['message' => 'Role updated successfully!', 'role' => $role]);
    }

    public function destroy(int $id): RedirectResponse {
        $role = Role::find($id);

        if (!$role) {
            return back()->withErrors(['message' => 'Role not found!'], 404);
        }

        $role->delete();

        return back()->with(['message' => 'Role deleted successfully!']);
    }
}
