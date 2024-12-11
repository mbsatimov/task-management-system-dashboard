<?php

namespace App\Http\Controllers;

use App\Actions\StudentTask\StudentTaskGetAction;
use App\Actions\StudentTask\StudentTaskGetPaginatedAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentTaskController extends Controller
{
    /**
     * @param Request $request
     * @param StudentTaskGetPaginatedAction $studentTaskGetPaginatedAction
     * @return JsonResponse
     */
    public function index(Request $request, StudentTaskGetPaginatedAction $studentTaskGetPaginatedAction): JsonResponse
    {
        $user = Auth::user();
        if (!$user->hasRole('student')) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
        $tasks = $studentTaskGetPaginatedAction($request, $user);

        return response()->json([
            'data' => $tasks,
            'status' => true,
            'message' => 'Tasks retrieved successfully'
        ]);
    }

    public function show($id, StudentTaskGetAction $studentTaskGetAction): JsonResponse
    {
        $user = Auth::user();
        if (!$user->hasRole('student')) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
        $task = $studentTaskGetAction($user, $id);

        return response()->json([
            'data' => $task,
            'status' => true,
            'message' => 'Task retrieved successfully'
        ]);
    }
}
