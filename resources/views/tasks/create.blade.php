@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header fw-bold fs-5">
                ➕ Créer une nouvelle tâche
            </div>
            <div class="card-body p-4">

                {{-- Erreurs de validation --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    {{-- Titre --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                        >{{ old('description') }}</textarea>
                    </div>

                    {{-- Catégorie --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Choisir une catégorie --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Statut (par défaut: à faire) --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-select">
                            <option value="Todo"        @selected(old('status') == 'Todo')>À faire</option>
                            <option value="in progress" @selected(old('status') == 'in progress')>En cours</option>
                            <option value="done"        @selected(old('status') == 'done')>Terminé</option>
                        </select>
                    </div>

                    {{-- BONUS : Date d'échéance --}}
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Date d'échéance (optionnel)</label>
                        <input
                            type="date"
                            name="due_date"
                            id="due_date"
                            class="form-control @error('due_date') is-invalid @enderror"
                            value="{{ old('due_date') }}"
                        >
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Créer la tâche</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection