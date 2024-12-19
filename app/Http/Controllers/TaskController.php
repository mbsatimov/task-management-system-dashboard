<?php

namespace App\Http\Controllers;

use App\Actions\Task\TaskAssignStudentAction;
use App\Actions\Task\TaskDestroyAction;
use App\Actions\Task\TaskGetAction;
use App\Actions\Task\TaskGetPaginatedAction;
use App\Actions\Task\TaskRemoveStudentAction;
use App\Actions\Task\TaskStoreAction;
use App\Actions\Task\TaskUpdateAction;
use App\Actions\TaskCategory\TaskCategoryGetAllAction;
use App\Actions\User\UserGetPaginatedAction;
use App\Http\Requests\TaskGetPaginatedRequest;
use App\Http\Requests\TaskPostAssignStudentRequest;
use App\Http\Requests\TaskPostRequest;
use App\Http\Requests\TaskPutRequest;
use App\Http\Requests\TaskRemoveAssignedStudentRequest;
use App\Http\Requests\UserGetPaginatedRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * @param TaskGetPaginatedRequest $request
     * @param TaskGetPaginatedAction $taskGetPaginatedAction
     * @return Response
     */
    public function index(TaskGetPaginatedRequest $request, TaskGetPaginatedAction $taskGetPaginatedAction): Response
    {
        $tasks = $taskGetPaginatedAction($request);

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param Task $task
     * @param TaskGetAction $taskGetAction
     * @return Response
     */
    public function show(Task $task, TaskGetAction $taskGetAction): Response
    {
        $task = $taskGetAction($task);

        return Inertia::render('Tasks/Show', [
            'task' => $task,
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
     * @param UserGetPaginatedRequest $request
     * @param TaskCategoryGetAllAction $taskCategoryGetAllAction
     * @param UserGetPaginatedAction $userGetPaginatedAction
     * @return Response
     */
    public function create(
        UserGetPaginatedRequest     $request,
        TaskCategoryGetAllAction    $taskCategoryGetAllAction,
        UserGetPaginatedAction      $userGetPaginatedAction
    ): Response {
        $categories = $taskCategoryGetAllAction();
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
     * @param UserGetPaginatedRequest $request
     * @param Task $task
     * @param TaskGetAction $taskGetAction
     * @param TaskCategoryGetAllAction $taskCategoryGetAllAction
     * @param UserGetPaginatedAction $userGetPaginatedAction
     * @return Response
     */
    public function edit(
        UserGetPaginatedRequest  $request,
        Task                     $task,
        TaskGetAction            $taskGetAction,
        TaskCategoryGetAllAction $taskCategoryGetAllAction,
        UserGetPaginatedAction   $userGetPaginatedAction
    ): Response {
        $task = $taskGetAction($task);
        $categories = $taskCategoryGetAllAction();
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
        TaskPutRequest      $request,
        Task                $task,
        TaskUpdateAction    $taskUpdateAction
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

    /**
     * @param TaskPostAssignStudentRequest $request
     * @param int $id
     * @param TaskAssignStudentAction $taskAssignStudentAction
     * @return RedirectResponse
     */
    public function assignStudent(
        TaskPostAssignStudentRequest    $request,
        int                             $id,
        TaskAssignStudentAction         $taskAssignStudentAction
    ): RedirectResponse {
        $validated = $request->validated();
        $taskAssignStudentAction($id, $validated['student_id']);

        return redirect('tasks')->with('message', 'Student assigned to task successfully');
    }

    /**
     * @param TaskRemoveAssignedStudentRequest $request
     * @param int $id
     * @param TaskRemoveStudentAction $taskRemoveStudentAction
     * @return RedirectResponse
     */
    public function removeStudent(
        TaskRemoveAssignedStudentRequest    $request,
        int                                 $id,
        TaskRemoveStudentAction             $taskRemoveStudentAction
    ): RedirectResponse {
        $validated = $request->validated();
        $taskRemoveStudentAction($id, $validated['student_id']);

        return redirect('tasks/' . $id)->with('message', 'Student removed from task successfully');
    }
}
