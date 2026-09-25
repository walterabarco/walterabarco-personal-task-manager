<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 1. Display a listing of all tasks with summary counts
    public function index()
    {
        $tasks = Task::all();
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 'Completed')->count();
        $pendingTasks = $tasks->where('status', 'Pending')->count();

        return view('tasks.index', compact('tasks', 'totalTasks', 'completedTasks', 'pendingTasks'));
    }

    // 2. Show the form for creating a new task
    public function create()
    {
        return view('tasks.create');
    }

    // 3. Store a newly created task in the database
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        Task::create($request->all());

        return redirect('/tasks')
            ->with('success', 'Task created successfully.');
    }

    // 4. Show the form for editing the specified task
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // 5. Update the specified task in the database
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect('/tasks')
            ->with('success', 'Task updated successfully.');
    }

    // 6. Remove the specified task from the database
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks')
            ->with('success', 'Task deleted successfully.');
    }
}