<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['middleware' => ['role:super-admin|admin']], function () {
    Route::resource('task-categories', TaskCategoryController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});

Route::group(['middleware' => ['role:super-admin|admin|mentor']], function () {
    Route::resource('tasks', TaskController::class);
    Route::post('/tasks/{id}/student', [TaskController::class, 'assignStudent']);
    Route::delete('/tasks/{id}/student', [TaskController::class, 'removeStudent']);
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
