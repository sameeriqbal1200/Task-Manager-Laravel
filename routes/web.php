<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

Route::get('/', [ProjectController::class, 'index']);

Route::resource('projects', ProjectController::class)->except(['show']);
Route::resource('tasks', TaskController::class)->except(['show']);
Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');