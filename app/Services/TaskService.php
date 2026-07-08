<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\Task;

class TaskService
{
    public function store(array $data)
    {
        try{
            $task = Task::create($data);
            return $task;
        } catch (\Exception $e) {
           Log::error($e->getMessage());
           return false;
        }
    }

    public function update($id, $data)
    {
        try{
            $task = Task::where('id', $id)->first();
            $task->update($data);
            return [
                'status' => true,
                'data' => $task,
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Failed to update task',
            ];
        }
    }

    public function destroy($id)
    {
        try{
            $task = Task::where('id', $id)->first();
            $task->delete();
            return [
                'status' => true,
                'message' => 'Task deleted successfully',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Failed to delete task',
            ];
        }
    }
}