<?php

namespace App\Http\Controllers\Tenancy;

use App\Http\Controllers\Controller;
use App\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate();
        return view('tenancy.task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenancy.task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();

        $data['image_url'] = Storage::put('tasks', $request->file('image_url'));

        Task::create($data);


        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tenancy.task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tenancy.task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image_url' => 'nullable|image',
        ]);

        // Verificar si se ha mandado una imagen
        if ($request->hasFile('image_url')) {

            // Eliminar la imagen anterior
            Storage::delete($task->image_url);
            // Guardar la nueva imagen
            $data['image_url'] = Storage::put('tasks', $request->file('image_url'));
        };

        $task->update($data);

        return redirect()->route('tasks.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

        Storage::delete($task->image_url);
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
