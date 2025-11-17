<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // project 

    Route::get('/projects', [ProjectController::class, 'index']);

    Route::post('/projects', [ProjectController::class, 'store']);

    Route::get('/projects/{project}', [ProjectController::class, 'show']);


    // Tasks
    Route::post('/tasks', [TaskController::class, 'store']);

    Route::put('/tasks/{task}', [TaskController::class, 'update']); 

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']); 

});
