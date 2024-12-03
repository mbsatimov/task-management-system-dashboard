<?php

namespace App\Http\Controllers;

use App\Actions\Task\TaskDestroyAction;
use App\Actions\Task\TaskGetPaginatedWithUsersAction;
use App\Actions\Task\TaskStoreAction;
use App\Actions\Task\TaskUpdateAction;
use App\Actions\TaskCategory\TaskCategoryGetAllAction;
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
    /**
     * @param Request $request
     * @param TaskGetPaginatedWithUsersAction $taskGetPaginatedWithUsersAction
     * @return Response
     */
    public function index(Request $request, TaskGetPaginatedWithUsersAction $taskGetPaginatedWithUsersAction): Response
    {
        $tasks = $taskGetPaginatedWithUsersAction($request);

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param TaskPostRequest $request
     * @param TaskStoreAction $taskStoreAction
     * @return RedirectResponse
     */
    public function store(TaskPostRequest $request, TaskStoreAction $taskStoreAction): RedirectResponse
    {
        $validated = $request->validated();
        $taskStoreAction($validated);

        return redirect('tasks')->with('message', 'Task created successfully');
    }

    /**
     * @param Request $request
     * @param UserGetPaginatedWithRolesAction $userGetAllAction
     * @param TaskCategoryGetAllAction $taskCategoryGetAllAction
     * @return Response
     */
    public function create(Request $request, UserGetPaginatedWithRolesAction $userGetAllAction, TaskCategoryGetAllAction $taskCategoryGetAllAction): Response
    {
        $users = $userGetAllAction($request);
        $categories = $taskCategoryGetAllAction($request);

        return Inertia::render('Tasks/Create', [
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @param Task $task
     * @param UserGetPaginatedWithRolesAction $userGetPaginatedWithRolesAction
     * @return Response
     */
    public function edit(Request $request, Task $task, UserGetPaginatedWithRolesAction $userGetPaginatedWithRolesAction): Response
    {
        $users = $userGetPaginatedWithRolesAction($request);

        return Inertia::render('Tasks/Edit', [
            'task' => $task,
            'users' => $users
        ]);
    }

    /**
     * @param TaskPutRequest $request
     * @param Task $task
     * @param TaskUpdateAction $taskUpdateAction
     * @return RedirectResponse
     */
    public function update(TaskPutRequest $request, Task $task, TaskUpdateAction $taskUpdateAction): RedirectResponse
    {
        $validated = $request->validated();
        $taskUpdateAction($task, $validated);

        return redirect('tasks')->with('message', 'Task updated successfully');
    }

    /**
     * @param Task $task
     * @param TaskDestroyAction $taskDestroyAction
     * @return RedirectResponse
     */
    public function destroy(Task $task, TaskDestroyAction $taskDestroyAction): RedirectResponse
    {
        $taskDestroyAction($task);

        return redirect('tasks')->with('message', 'Task deleted successfully');
    }
}
