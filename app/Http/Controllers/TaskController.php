<?php

namespace App\Http\Controllers;

use App\Actions\Task\TaskDestroyAction;
use App\Actions\Task\TaskGetPaginatedWithUsersAction;
use App\Actions\Task\TaskStoreAction;
use App\Actions\Task\TaskUpdateAction;
use App\Actions\User\UserGetPaginatedWithRolesAction;
use App\Http\Requests\TaskPostRequest;
use App\Http\Requests\TaskPutRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    public function index(Request $request, TaskGetPaginatedWithUsersAction $taskGetPaginatedWithUsersAction): Response
    {
        $tasks = $taskGetPaginatedWithUsersAction($request);

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
            'searchTerm' => $request->search
        ]);
    }

    public function store(TaskPostRequest $request, TaskStoreAction $taskStoreAction): RedirectResponse
    {
        $validated = $request->validated();
        $taskStoreAction($validated);

        return redirect('tasks')->with('message', 'Task created successfully');
    }

    public function create(Request $request, UserGetPaginatedWithRolesAction $userGetAllAction): Response
    {
        $users = $userGetAllAction($request);

        return Inertia::render('Tasks/Create', [
            'users' => $users
        ]);
    }

    public function edit(Request $request, Task $task, UserGetPaginatedWithRolesAction $userGetPaginatedWithRolesAction): Response
    {
        $users = $userGetPaginatedWithRolesAction($request);

        return Inertia::render('Tasks/Edit', [
            'task' => $task,
            'users' => $users
        ]);
    }

    public function update(TaskPutRequest $request, Task $task, TaskUpdateAction $taskUpdateAction): RedirectResponse
    {
        $validated = $request->validated();
        $taskUpdateAction($task, $validated);

        return redirect('tasks')->with('message', 'Task updated successfully');
    }

    public function destroy(Task $task, TaskDestroyAction $taskDestroyAction): RedirectResponse
    {
        $taskDestroyAction($task);

        return redirect('tasks')->with('message', 'Task deleted successfully');
    }
}
