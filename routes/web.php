<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['middleware' => ['role:super-admin|admin']], function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

Route::group(['middleware' => ['role:super-admin|admin|mentor']], function () {
    Route::get('/tasks', function () {
        return Inertia::render("Tasks");
    });

    Route::get('/groups', function () {
        return Inertia::render("Groups");
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/', function () {
        return Inertia::render("Home");
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerPage']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
