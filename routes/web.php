<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'matchUserWithDashboard'])->name('dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->middleware('role:admin')->name('admin.dashboard');

    Route::get('/manager/dashboard', [DashboardController::class, 'managerDashboard'])->middleware('role:manager')->name('manager.dashboard');

    Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])->middleware('role:employee')->name('employee.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class)->except(['create', 'edit', 'show']);

    Route::get('projects/{project}', [ProjectController::class, 'show'])
        ->middleware('can:view,project')->name('projects.show');

    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

require __DIR__ . '/auth.php';
