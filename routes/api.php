<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Endpoints
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/profile', [ProfileController::class, 'show']);
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:10,1');

// Auth Endpoints
Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Admin CRUD
    Route::post('/admin/projects', [ProjectController::class, 'store']);
    Route::put('/admin/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/admin/projects/{project}', [ProjectController::class, 'destroy']);

    Route::post('/admin/tasks', [TaskController::class, 'store']);
    Route::put('/admin/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/admin/tasks/{task}', [TaskController::class, 'destroy']);

    Route::put('/admin/profile', [ProfileController::class, 'update']);

    Route::get('/admin/messages', [ContactController::class, 'index']);
    Route::delete('/admin/messages/{message}', [ContactController::class, 'destroy']);
});
