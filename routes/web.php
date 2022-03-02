<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    return view('welcome', ['projects'=>\App\Models\Project::all()]);
});

Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::put('/projects/{project?}', [ProjectController::class, 'update'])->name('projects.update');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::patch('/tasks', [TaskController::class, 'updatePriority'])->name('tasks.updatePriority');
Route::put('/tasks/{task?}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
