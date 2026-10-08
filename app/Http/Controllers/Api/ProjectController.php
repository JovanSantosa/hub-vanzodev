<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::orderBy('order', 'asc')->get();
        return response()->json($projects);
    }

    public function show(Project $project): JsonResponse
    {
        return response()->json($project);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:50',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'tech_stack' => 'nullable|array',
            'live_url' => 'nullable|string|max:255',
            'repo_url' => 'nullable|string|max:255',
            'endpoint' => 'nullable|string|max:255',
            'env_badge' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['tech_stack'] = $validated['tech_stack'] ?? [];
        $validated['order'] = $validated['order'] ?? (Project::max('order') + 1);

        $project = Project::create($validated);

        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project,
        ], 201);
    }

    public function update(Request $request, Project $project): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'category' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:50',
            'summary' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'tech_stack' => 'nullable|array',
            'live_url' => 'nullable|string|max:255',
            'repo_url' => 'nullable|string|max:255',
            'endpoint' => 'nullable|string|max:255',
            'env_badge' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $project->update($validated);

        return response()->json([
            'message' => 'Project updated successfully',
            'project' => $project,
        ]);
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
