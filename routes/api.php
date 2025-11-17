<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/projects', [ProjectController::class, 'index']);

    // project 

    Route::post('/projects', [ProjectController::class, 'store']);

    Route::get('/projects/{project}', [ProjectController::class, 'show']);


    // // Tasks
    //  Route::post('/tasks', [TaskController::class, 'store']);         
    // Route::put('/tasks/{task}', [TaskController::class, 'update']);   Employee
    // Route::delete('/tasks/{task}', [TaskController::class, 'destroy']); 
});
