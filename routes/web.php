<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/', function () {
    return Inertia::render("Home");
});

Route::get('/tasks', function () {
    return Inertia::render("Tasks");
});

Route::get('/mentods', function () {
    return Inertia::render("Mentors");
});

Route::get('/groups', function () {
    return Inertia::render("Groups");
});

Route::get('/users', [UserController::class, 'index']);

Route::resource('roles', RoleController::class);

Route::get('/permissions', [PermissionController::class, 'index']);
