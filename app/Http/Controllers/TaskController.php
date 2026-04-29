<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {
        $categories =  Category::all();

        $tasks = Task::query()->where('user_id', Auth::id());

        if ($request->filled('category_id')) {
            $tasks->where('category_id', $request->category_id);
        }
        

        if ($request->filled('status')){
            $tasks->where('status', $request->status);
        }

        $counts = [
            'Todo'        => Task::where('user_id', Auth::id())->where('status', 'Todo')->count(),
            'in_progress' => Task::where('user_id', Auth::id())->where('status', 'in progress')->count(),
            'done'        => Task::where('user_id', Auth::id())->where('status', 'done')->count(),
        ];

        $tasks = $tasks->latest()->Paginate(8);
        return view('tasks.index', compact('tasks', 'categories', 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'in:Todo,in progress,done',
            'due_date'    => 'nullable|date',   // BONUS
        ]);

        $validated['user_id'] =  Auth::id();
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Category::all();

        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'in:Todo,in progress,done',
            'due_date'    => 'nullable|date',   // BONUS
        ]);

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    
}
