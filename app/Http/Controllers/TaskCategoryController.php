<?php

namespace App\Http\Controllers;

use App\Actions\TaskCategory\TaskCategoryDestroyAction;
use App\Actions\TaskCategory\TaskCategoryGetAllAction;
use App\Actions\TaskCategory\TaskCategoryStoreAction;
use App\Actions\TaskCategory\TaskCategoryUpdateAction;
use App\Http\Requests\TaskCategoryPostRequest;
use App\Http\Requests\TaskCategoryPutRequest;
use App\Models\TaskCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskCategoryController extends Controller
{
    public function index(Request $request, TaskCategoryGetAllAction $taskCategoryGetAllAction): Response
    {
        $taskCategories = $taskCategoryGetAllAction($request);
        return Inertia::render('TaskCategories/Index', [
            'taskCategories' => $taskCategories,
            'searchTerm' => $request->search
        ]);
    }

    public function store(TaskCategoryPostRequest $request, TaskCategoryStoreAction $taskCategoryStoreAction): RedirectResponse
    {
        $validated = $request->validated();

        $taskCategoryStoreAction($validated);

        return redirect('task-categories')->with('message', 'Task category created successfully');
    }

    public function create(): Response
    {
        return Inertia::render('TaskCategories/Create');
    }

    public function edit(TaskCategory $taskCategory): Response
    {
        return Inertia::render('TaskCategories/Edit', [
            'taskCategory' => $taskCategory
        ]);
    }

    public function update(TaskCategoryPutRequest $request, TaskCategory $taskCategory, TaskCategoryUpdateAction $taskCategoryUpdateAction): RedirectResponse
    {
        $validated = $request->validated();

        $taskCategoryUpdateAction($taskCategory, $validated);

        return redirect('task-categories')->with('message', 'Task category updated successfully');
    }

    public function destroy(TaskCategory $taskCategory, TaskCategoryDestroyAction $taskCategoryDestroyAction): RedirectResponse
    {
        $taskCategoryDestroyAction($taskCategory);
        return redirect('task-categories')->with('message', 'Task category deleted successfully');
    }
}
