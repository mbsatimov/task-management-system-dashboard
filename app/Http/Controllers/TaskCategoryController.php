<?php

namespace App\Http\Controllers;

use App\Actions\TaskCategory\TaskCategoryDestroyAction;
use App\Actions\TaskCategory\TaskCategoryGetAllAction;
use App\Actions\TaskCategory\TaskCategoryStoreAction;
use App\Actions\TaskCategory\TaskCategoryUpdateAction;
use App\Http\Requests\TaskCategoryGetAllRequest;
use App\Http\Requests\TaskCategoryPostRequest;
use App\Http\Requests\TaskCategoryPutRequest;
use App\Models\TaskCategory;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TaskCategoryController extends Controller
{
    /**
     * @param TaskCategoryGetAllRequest $request
     * @param TaskCategoryGetAllAction $taskCategoryGetAllAction
     * @return Response
     */
    public function index(TaskCategoryGetAllRequest $request, TaskCategoryGetAllAction $taskCategoryGetAllAction): Response
    {
        $taskCategories = $taskCategoryGetAllAction($request);

        return Inertia::render('TaskCategories/Index', [
            'taskCategories' => $taskCategories,
            'searchTerm' => $request->search
        ]);
    }

    /**
     * @param TaskCategoryPostRequest $request
     * @param TaskCategoryStoreAction $taskCategoryStoreAction
     * @return RedirectResponse
     */
    public function store(
        TaskCategoryPostRequest $request,
        TaskCategoryStoreAction $taskCategoryStoreAction
    ): RedirectResponse {
        $validated = $request->validated();
        $taskCategoryStoreAction($validated);

        return redirect('task-categories')->with('message', 'Task category created successfully');
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('TaskCategories/Create');
    }

    /**
     * @param TaskCategory $taskCategory
     * @return Response
     */
    public function edit(TaskCategory $taskCategory): Response
    {
        return Inertia::render('TaskCategories/Edit', [
            'taskCategory' => $taskCategory
        ]);
    }

    /**
     * @param TaskCategoryPutRequest $request
     * @param TaskCategory $taskCategory
     * @param TaskCategoryUpdateAction $taskCategoryUpdateAction
     * @return RedirectResponse
     */
    public function update(
        TaskCategoryPutRequest $request,
        TaskCategory $taskCategory,
        TaskCategoryUpdateAction $taskCategoryUpdateAction
    ): RedirectResponse {
        $validated = $request->validated();
        $taskCategoryUpdateAction($taskCategory, $validated);

        return redirect('task-categories')->with('message', 'Task category updated successfully');
    }

    /**
     * @param TaskCategory $taskCategory
     * @param TaskCategoryDestroyAction $taskCategoryDestroyAction
     * @return RedirectResponse
     */
    public function destroy(
        TaskCategory $taskCategory,
        TaskCategoryDestroyAction $taskCategoryDestroyAction
    ): RedirectResponse {
        $taskCategoryDestroyAction($taskCategory);

        return redirect('task-categories')->with('message', 'Task category deleted successfully');
    }
}
