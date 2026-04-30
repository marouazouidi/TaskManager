@extends('layouts.app')

@section('content')
<style>
    .tf-form-wrap { font-family: 'Outfit', sans-serif; max-width: 580px; margin: 0 auto; }
    .tf-form-header { text-align: center; margin-bottom: 32px; }
    .tf-form-header-icon { display: inline-flex; align-items: center; justify-content: center; margin-bottom: 8px; }
    .tf-form-header-icon svg { width: 32px; height: 32px; color: #7c3aed; }
    .tf-form-header h1 { font-size: 1.75rem; font-weight: 700; color: #1a1a2e; margin: 0 0 6px; }
    .tf-form-header p { font-size: 0.9rem; color: #9a8fb0; margin: 0; }

    .tf-form-card { background: #fff; border-radius: 20px; padding: 36px 32px; box-shadow: 0 2px 16px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.04); }

    .tf-alert { display: flex; align-items: center; gap: 12px; padding: 14px 20px; border-radius: 12px; background: #fef2f2; border: 1px solid #fecaca; margin-bottom: 24px; }
    .tf-alert-icon { flex-shrink: 0; width: 22px; height: 22px; color: #dc2626; }
    .tf-alert-text { font-size: 0.85rem; color: #991b1b; font-weight: 500; }

    .tf-group { margin-bottom: 20px; }
    .tf-label { display: block; font-size: 0.85rem; font-weight: 500; color: #3a2550; margin-bottom: 8px; }
    .tf-label .req { color: #dc2626; }
    .tf-input, .tf-textarea, .tf-select, .tf-date { width: 100%; padding: 14px 18px; background: #f5f3f8; border: 1px solid transparent; border-radius: 12px; font-family: 'Outfit', sans-serif; font-size: 0.9rem; color: #2d1b3e; outline: none; transition: all 0.2s; }
    .tf-input:focus, .tf-textarea:focus, .tf-select:focus, .tf-date:focus { border-color: #c084fc; background: #faf8ff; box-shadow: 0 0 0 3px rgba(192,132,252,0.1); }
    .tf-input::placeholder, .tf-textarea::placeholder { color: #b8aac8; }
    .tf-textarea { resize: vertical; min-height: 100px; }
    .tf-select { appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b5b7b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 16px center; padding-right: 40px; cursor: pointer; }
    .tf-input.is-invalid, .tf-select.is-invalid, .tf-textarea.is-invalid { border-color: #fca5a5; background: #fff5f5; }
    .tf-error { font-size: 0.78rem; color: #dc2626; margin-top: 6px; padding-left: 4px; }

    .tf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .tf-buttons { display: flex; gap: 14px; margin-top: 28px; }
    .tf-btn-cancel { flex: 0 0 auto; padding: 14px 32px; border: 1px solid #e0d8f0; border-radius: 50px; background: #fff; color: #5a4a6a; font-family: 'Outfit', sans-serif; font-size: 0.9rem; font-weight: 500; text-decoration: none; text-align: center; transition: all 0.2s; cursor: pointer; }
    .tf-btn-cancel:hover { border-color: #c084fc; color: #6a3d9a; }
    .tf-btn-submit { flex: 1; padding: 14px 32px; border: none; border-radius: 50px; background: linear-gradient(135deg, #e8a0c8 0%, #c084fc 50%, #a78bfa 100%); color: #fff; font-family: 'Outfit', sans-serif; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 16px rgba(192,132,252,0.3); }
    .tf-btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(192,132,252,0.45); }
    .tf-btn-submit svg { width: 18px; height: 18px; }

    .tf-form-footer { text-align: center; margin-top: 24px; font-size: 0.78rem; color: #b8aac8; display: flex; align-items: center; justify-content: center; gap: 6px; }
    .tf-form-footer svg { width: 14px; height: 14px; }

    @media (max-width: 640px) {
        .tf-row { grid-template-columns: 1fr; }
        .tf-buttons { flex-direction: column; }
        .tf-form-card { padding: 28px 20px; }
    }
</style>

<div class="tf-form-wrap">

    {{-- Header --}}
    <div class="tf-form-header">
        
        <h1>Modifier la tâche</h1>
        <p>Mettez à jour les détails de votre tâche.</p>
    </div>

    {{-- Card --}}
    <div class="tf-form-card">

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="tf-alert">
                <svg class="tf-alert-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                <span class="tf-alert-text">Veuillez remplir tous les champs obligatoires</span>
            </div>
        @endif

        {{-- PUT pour la modification (Laravel simule PUT avec _method) --}}
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Titre --}}
            <div class="tf-group">
                <label for="title" class="tf-label">Titre <span class="req">*</span></label>
                <input type="text" name="title" id="title" class="tf-input @error('title') is-invalid @enderror" value="{{ old('title', $task->title) }}" placeholder="Ex: Finaliser le design system" required>
                @error('title')
                    <div class="tf-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="tf-group">
                <label for="description" class="tf-label">Description (Optionnel)</label>
                <textarea name="description" id="description" class="tf-textarea" placeholder="Détails de la tâche...">{{ old('description', $task->description) }}</textarea>
            </div>

            {{-- Catégorie + Statut --}}
            <div class="tf-row">
                <div class="tf-group">
                    <label for="category_id" class="tf-label">Catégorie <span class="req">*</span></label>
                    <select name="category_id" id="category_id" class="tf-select" required>
                        <option value="">Choisir une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $task->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="tf-group">
                    <label for="status" class="tf-label">Statut</label>
                    <select name="status" id="status" class="tf-select">
                        <option value="Todo" @selected(old('status', $task->status) == 'Todo')>À faire</option>
                        <option value="in progress" @selected(old('status', $task->status) == 'in progress')>En cours</option>
                        <option value="done" @selected(old('status', $task->status) == 'done')>Terminé</option>
                    </select>
                </div>
            </div>

            {{-- Date d'échéance --}}
            <div class="tf-group">
                <label for="due_date" class="tf-label">Date d'échéance (Optionnel)</label>
                <input type="date" name="due_date" id="due_date" class="tf-date" value="{{ old('due_date', $task->due_date) }}">
            </div>

            {{-- Buttons --}}
            <div class="tf-buttons">
                <a href="{{ route('tasks.index') }}" class="tf-btn-cancel">Annuler</a>
                <button type="submit" class="tf-btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Enregistrer
                </button>
            </div>

        </form>
    </div>

    {{-- Footer --}}
    <div class="tf-form-footer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
        Les modifications sont enregistrées automatiquement.
    </div>

</div>
@endsection