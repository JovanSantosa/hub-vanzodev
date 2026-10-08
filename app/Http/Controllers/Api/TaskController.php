<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $scope = $request->query('scope', 'public');
        if ($scope === 'private') {
            $tasks = Task::where('is_private', true)->orderBy('order', 'asc')->get();
        } elseif ($scope === 'all') {
            $tasks = Task::orderBy('order', 'asc')->get();
        } else {
            $tasks = Task::where('is_private', false)->orderBy('order', 'asc')->get();
        }
        return response()->json($tasks);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'nullable|string|in:pending,in_progress,completed',
            'priority' => 'nullable|string|in:low,medium,high',
            'target_quarter' => 'nullable|string|max:50',
            'is_private' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['status'] = $validated['status'] ?? 'pending';
        $validated['priority'] = $validated['priority'] ?? 'medium';
        $validated['target_quarter'] = $validated['target_quarter'] ?? 'Q4 2026';
        $validated['is_private'] = $validated['is_private'] ?? false;
        $validated['order'] = $validated['order'] ?? (Task::max('order') + 1);

        $task = Task::create($validated);

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task,
        ], 201);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'status' => 'nullable|string|in:pending,in_progress,completed',
            'priority' => 'nullable|string|in:low,medium,high',
            'target_quarter' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task,
        ]);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
