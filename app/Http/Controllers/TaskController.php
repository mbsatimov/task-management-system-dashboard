<?php

namespace App\Http\Controllers;

use App\Actions\Task\TaskDestroyAction;
use App\Actions\Task\TaskGetPaginatedAction;
use App\Actions\Task\TaskGetWithTaskCategoryAction;
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
     * @param TaskGetPaginatedAction $taskGetPaginatedAction
     * @return Response
     */
    public function index(Request $request, TaskGetPaginatedAction $taskGetPaginatedAction): Response
    {
        $tasks = $taskGetPaginatedAction($request);

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
     * @param TaskCategoryGetAllAction $taskCategoryGetAllAction
     * @param UserGetPaginatedWithRolesAction $userGetPaginatedAction
     * @return Response
     */
    public function create(
        Request $request,
        TaskCategoryGetAllAction $taskCategoryGetAllAction,
        UserGetPaginatedWithRolesAction $userGetPaginatedAction
    ): Response {
        $categories = $taskCategoryGetAllAction($request);
        $students = $userGetPaginatedAction($request, 'student');
        $mentors = $userGetPaginatedAction($request, 'mentor');

        return Inertia::render('Tasks/Create', [
            'categories' => $categories,
            'students' => $students,
            'mentors' => $mentors,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param Request $request
     * @param Task $task
     * @param TaskGetWithTaskCategoryAction $taskGetWithTaskCategoryAction
     * @param TaskCategoryGetAllAction $taskCategoryGetAllAction
     * @param UserGetPaginatedWithRolesAction $userGetPaginatedAction
     * @return Response
     */
    public function edit(
        Request $request,
        Task $task,
        TaskGetWithTaskCategoryAction $taskGetWithTaskCategoryAction,
        TaskCategoryGetAllAction        $taskCategoryGetAllAction,
        UserGetPaginatedWithRolesAction $userGetPaginatedAction
    ): Response {
        $task = $taskGetWithTaskCategoryAction($task);
        $categories = $taskCategoryGetAllAction($request);
        $students = $userGetPaginatedAction($request, 'student');
        $mentors = $userGetPaginatedAction($request, 'mentor');

        return Inertia::render('Tasks/Edit', [
            'task' => $task,
            'categories' => $categories,
            'students' => $students,
            'mentors' => $mentors,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param TaskPutRequest $request
     * @param Task $task
     * @param TaskUpdateAction $taskUpdateAction
     * @return RedirectResponse
     */
    public function update(
        TaskPutRequest $request,
        Task $task,
        TaskUpdateAction $taskUpdateAction
    ): RedirectResponse {
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
