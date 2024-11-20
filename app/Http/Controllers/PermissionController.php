<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Permissions', [
            'permissions' => Permission::all(),
        ]);
    }

    public function post(Request $request): void {
        $validated = $request->validated();

        Permission::create($validated);
    }

}
