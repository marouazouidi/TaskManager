@extends('layouts.app')

@section('content')

    <h2 class="text-3xl font-bold mb-6">
        📋 Mes Tâches
    </h2>



    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500">Done</h3>
            <p class="text-3xl font-bold">{{ $counts['done'] }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500">
                Todo
            </h3>
            <p class="text-3xl font-bold">
                {{ $counts['Todo'] }}
            </p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500">
                In Progress
            </h3>
            <p class="text-3xl font-bold">
                {{ $counts['in_progress'] }}
            </p>
        </div>

    </div>


    <div class="mb-6">
        <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add Task
        </a>
    </div>

    <form action="{{ route('tasks.index') }}" method="GET" class="row g-3 align-items-end">
        {{-- Filtre par statut --}}
        <div class="col-md-4">
            <label for="status" class="form-label">Filtrer par statut</label>
            <select name="status" id="status" class="form-select">
                <option value="">-- Tous les statuts --</option>
                <option value="Todo" @selected(request('status') == 'Todo')>À faire</option>
                <option value="in progress" @selected(request('status') == 'in progress')>En cours</option>
                <option value="done" @selected(request('status') == 'done')>Terminé</option>
            </select>
        </div>

        {{-- Filtre par catégorie --}}
        <div class="col-md-4">
            <label for="category_id" class="form-label">Filtrer par catégorie</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">-- Toutes les catégories --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Boutons --}}
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrer</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
        </div>
    </form>

    @if($tasks->isEmpty())
        <div class="alert alert-info">Aucune tâche trouvée. Créez-en une !</div>
    @else

        <div class="bg-white shadow rounded overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4">Title</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($tasks as $task)

                        <tr class="border-b">

                            <td class="p-4">
                                {{ $task->title }}
                            </td>

                            <td>

                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <select name="status" onchange="this.form.submit()" class="border rounded p-2">
                                        <option value="Todo" {{ $task->status == 'Todo' ? 'selected' : '' }}>
                                            Todo
                                        </option>

                                        <option value="in progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>
                                            In Progress
                                        </option>

                                        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>
                                            Done
                                        </option>

                                    </select>

                                    <input type="hidden" name="title" value="{{ $task->title }}">

                                    <input type="hidden" name="description" value="{{ $task->description }}">

                                    <input type="hidden" name="category_id" value="{{ $task->category_id }}">

                                </form>

                            </td>


                            <td>
                                {{ $task->category->name }}
                            </td>

                            <td>
                                @if($task->due_date)
                                <span
                                style="{{ ($task->due_date->isPast() && $task->status !== 'done') ? 'color:red;font-weight:bold;' : '' }}">
                                {{ $task->due_date->format('d/m/Y') }}
                                </span>
                                @endif
                            </td>
                            


                            <td class="space-x-2">

                                <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 text-white px-3 py-2 rounded">
                                    Edit
                                </a>


                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Delete?')" class="bg-red-500 text-white px-3 py-2 rounded">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- BONUS : Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $tasks->withQueryString()->links() }}
        </div>

    @endif

@endsection