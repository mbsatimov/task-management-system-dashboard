<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render("Home");
})->name('home');

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/tasks', function () {
    return Inertia::render("Tasks");
})->name('tasks');

Route::get('/mentods', function () {
    return Inertia::render("Mentors");
})->name('mentors');

Route::get('/groups', function () {
    return Inertia::render("Groups");
})->name('groups');
