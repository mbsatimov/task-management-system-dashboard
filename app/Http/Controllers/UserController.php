<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); // Use pagination for large datasets

        return Inertia::render('Users', [
            'users' => $users,
        ]);
    }
}
