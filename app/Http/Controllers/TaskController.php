<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->project_id;
        $tasks = Task::where('project_id', $projectId)->orderBy('priority', 'asc')->get();
        $projects = Project::all();
        return view('tasks.index', compact('tasks', 'projects', 'projectId'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
        ]);

        $maxPriority = Task::where('project_id', $request->project_id)->max('priority') ?? 0;
        Task::create([
            'name' => $validated['name'],
            'priority' => $maxPriority + 1,
            'project_id' => $request->project_id,
        ]);

        return redirect()->route('tasks.index', ['project_id' => $request->project_id])
            ->with('success', 'Task created successfully!');
    }

    public function updatePriorities(Request $request)
    {
        $tasks = $request->tasks;
        foreach ($tasks as $i => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $i + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }

    public function reorder(Request $request)
    {
        $reorderedIds = $request->order;

        foreach ($reorderedIds as $priority => $id) {
            Task::where('id', $id)->update(['priority' => $priority + 1]);
        }

        return response()->json(['success' => true]);
    }

}