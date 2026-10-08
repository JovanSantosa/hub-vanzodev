<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfileSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        $profile = ProfileSetting::first();
        return response()->json($profile);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'role' => 'sometimes|string|max:255',
            'headline' => 'sometimes|string|max:255',
            'bio_p1' => 'nullable|string',
            'bio_p2' => 'nullable|string',
            'email' => 'sometimes|email|max:255',
            'github_url' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'status_text' => 'nullable|string|max:255',
        ]);

        $profile = ProfileSetting::firstOrCreate(['id' => 1]);
        $profile->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => $profile,
        ]);
    }
}
