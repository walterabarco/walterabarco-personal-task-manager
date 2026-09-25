<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Redirect home page to tasks list using relative path
Route::get('/', function () {
    return redirect('/tasks');
});

// Resource route for all task CRUD operations
Route::resource('tasks', TaskController::class);