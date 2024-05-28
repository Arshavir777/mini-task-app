<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends ApiController
{
    public function index()
    {
        $tasks = Task::with('subTasks')->get();

        // dd($tasks->load('subTasks'));

        // $authUser = auth()->user();
        // $tasks = $authUser->tasks()->with('subTasks')->get();
        return $this->successResponse(TaskResource::collection($tasks));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed,On Hold,Cancelled,Under Review,Approved,Rejected,Deferred'
        ]);

        return Task::create($request->all());
    }

    public function show($id)
    {
        return Task::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed,On Hold,Cancelled,Under Review,Approved,Rejected,Deferred'
        ]);

        $task->update($request->all());

        return $task;
    }

    public function destroy($id)
    {
        Task::destroy($id);

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
