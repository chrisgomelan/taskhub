<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskManagement;
use App\Services\TaskService;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->get();
        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return Inertia::render('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskManagement $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $task = $this->taskService->store($validatedData);
        if($task) {
            return redirect()->route('dashboard')->with('success', 'Task created successfully');
        }
        return redirect()->route('dashboard')->with('error', 'Failed to create task');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return Inertia::render('EditTask', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskManagement $request, Task $task)
    {
        $validatedData = $request->validated();
        $task = $this->taskService->update($task->id, $validatedData);
        if($task) {
            return redirect()->route('dashboard')->with('success', 'Task updated successfully');
        }
        return redirect()->route('dashboard')->with('error', 'Failed to update task');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task = $this->taskService->destroy($task->id);
        if($task) {
            return redirect()->route('dashboard')->with('success', 'Task deleted successfully');
        }
        return redirect()->route('dashboard')->with('error', 'Failed to delete task');
    }
}
