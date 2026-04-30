@extends('layouts.app')

@section('content')
    <style>
        .idx-wrap {
            font-family: 'Outfit', sans-serif;
        }

        .idx-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .idx-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .idx-title-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #f5e6d0, #e8c9a0);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .idx-title h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0;
        }

        .idx-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #6a3d9a, #8b5fd0);
            color: #fff;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 4px 16px rgba(106, 61, 154, 0.3);
            transition: all 0.3s ease;
        }

        .idx-add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(106, 61, 154, 0.45);
        }

        /* Stats Cards */
        .idx-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .idx-stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            transition: transform 0.2s ease;
        }

        .idx-stat-card:hover {
            transform: translateY(-2px);
        }

        .idx-stat-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .idx-stat-card.done .idx-stat-label {
            color: #c084fc;
        }

        .idx-stat-card.todo .idx-stat-label {
            color: #7c3aed;
        }

        .idx-stat-card.progress .idx-stat-label {
            color: #a78bfa;
        }

        .idx-stat-num {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1;
        }

        .idx-stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .idx-stat-card.done .idx-stat-icon {
            background: rgba(192, 132, 252, 0.12);
            color: #c084fc;
        }

        .idx-stat-card.todo .idx-stat-icon {
            background: rgba(124, 58, 237, 0.12);
            color: #7c3aed;
        }

        .idx-stat-card.progress .idx-stat-icon {
            background: rgba(167, 139, 250, 0.12);
            color: #a78bfa;
        }

        .idx-stat-icon svg {
            width: 20px;
            height: 20px;
        }

        /* Filter Bar */
        .idx-filter-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }


        .idx-filter-select {
            padding: 8px 32px 8px 16px;
            border: 1px solid #e0d8f0;
            border-radius: 50px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            color: #3a2550;
            background: #fff;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b5b7b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s;
        }

        .idx-filter-select:focus {
            border-color: #a78bfa;
        }

        .idx-filter-actions {
            margin-left: auto;
            display: flex;
            gap: 10px;
        }

        .idx-btn-filter {
            padding: 8px 24px;
            background: linear-gradient(135deg, #c084fc, #a78bfa);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .idx-btn-filter:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(167, 139, 250, 0.3);
        }

        .idx-btn-reset {
            padding: 8px 24px;
            background: #fff;
            color: #6b5b7b;
            border: 1px solid #e0d8f0;
            border-radius: 50px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-block;
        }

        .idx-btn-reset:hover {
            border-color: #a78bfa;
            color: #6a3d9a;
        }

        /* Table */
        .idx-table-wrap {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .idx-table {
            width: 100%;
            border-collapse: collapse;
        }

        .idx-table thead th {
            padding: 16px 20px;
            font-size: 0.8rem;
            font-weight: 500;
            color: #9a8fb0;
            text-align: left;
            border-bottom: 1px solid #f0ecf5;
        }

        .idx-table tbody tr {
            border-bottom: 1px solid #f8f5fc;
            transition: background 0.15s;
        }

        .idx-table tbody tr:last-child {
            border-bottom: none;
        }

        .idx-table tbody tr:hover {
            background: #fdfbff;
        }

        .idx-table tbody td {
            padding: 16px 20px;
            font-size: 0.9rem;
            color: #2d1b3e;
            vertical-align: middle;
        }

        /* Task title with icon */
        .idx-task-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        

        

        /* Status badge select */
        .idx-status-select {
            padding: 6px 28px 6px 12px;
            border: 1px solid #e8e0f0;
            border-radius: 50px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%236b5b7b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            cursor: pointer;
            outline: none;
        }

        .idx-status-select.status-todo {
            background-color: #f3e8ff;
            color: #7c3aed;
            border-color: #e9d5ff;
        }

        .idx-status-select.status-progress {
            background-color: #fef3c7;
            color: #d97706;
            border-color: #fde68a;
        }

        .idx-status-select.status-done {
            background-color: #d1fae5;
            color: #059669;
            border-color: #a7f3d0;
        }

        /* Category badge */
        .idx-cat-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 500;
            background: #f3e8ff;
            color: #7c3aed;
            border: 1px solid #e9d5ff;
        }

        /* Date */
        .idx-date {
            font-size: 0.85rem;
            color: #5a4a6a;
        }

        .idx-date-overdue {
            color: #dc2626;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.5px;
        }

        /* Action buttons */
        .idx-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .idx-act-btn {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .idx-act-btn svg {
            width: 16px;
            height: 16px;
        }

        .idx-act-edit {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .idx-act-edit:hover {
            background: rgba(34, 197, 94, 0.2);
        }

        .idx-act-del {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .idx-act-del:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Pagination */
        .idx-pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-top: 1px solid #f0ecf5;
        }

        .idx-pagination-info {
            font-size: 0.82rem;
            color: #9a8fb0;
        }

        .idx-pagination-wrap nav {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .idx-pagination-wrap nav>div {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .idx-pagination-wrap nav span>a,
        .idx-pagination-wrap nav span>span,
        .idx-pagination-wrap nav>a,
        .idx-pagination-wrap nav>span,
        .idx-pagination-wrap .page-link,
        .idx-pagination-wrap nav a,
        .idx-pagination-wrap nav span span {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 500;
            color: #6b5b7b;
            text-decoration: none;
            border: 1px solid #e8e0f0;
            transition: all 0.2s;
            background: #fff;
            line-height: 1;
            padding: 0;
        }

        .idx-pagination-wrap nav span[aria-current],
        .idx-pagination-wrap nav span[aria-current] span,
        .idx-pagination-wrap nav .active span,
        .idx-pagination-wrap nav span.bg-blue-500,
        .idx-pagination-wrap [aria-current="page"] span {
            background: linear-gradient(135deg, #c084fc, #a78bfa) !important;
            color: #fff !important;
            border-color: transparent !important;
        }

        .idx-pagination-wrap nav a:hover {
            border-color: #a78bfa;
            color: #6a3d9a;
            background: #faf5ff;
        }

        .idx-pagination-wrap nav span[aria-disabled] span,
        .idx-pagination-wrap nav .disabled span {
            color: #d4c8e8;
            border-color: #f0ecf5;
            cursor: default;
        }

        .idx-pagination-wrap p.text-sm {
            display: none;
        }
        

        /* Empty state */
        .idx-empty {
            text-align: center;
            padding: 48px 24px;
            color: #9a8fb0;
            font-size: 0.95rem;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        }

        /* Footer */
        .idx-footer {
            text-align: center;
            padding: 32px 0 16px;
            color: #b8aac8;
            font-size: 0.78rem;
        }

        .idx-footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 8px;
        }

        .idx-footer-links a {
            color: #9a8fb0;
            text-decoration: none;
            font-size: 0.78rem;
            transition: color 0.2s;
        }

        .idx-footer-links a:hover {
            color: #6a3d9a;
        }

        @media (max-width: 768px) {
            .idx-stats {
                grid-template-columns: 1fr;
            }

            .idx-table-wrap {
                overflow-x: auto;
            }

            .idx-filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .idx-filter-actions {
                margin-left: 0;
            }

            .idx-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
        }
    </style>

    <div class="idx-wrap">

        {{-- Header --}}
        <div class="idx-header">
            <div class="idx-title">
                <div class="idx-title-icon">📋</div>
                <h2>Mes Tâches</h2>
            </div>
            <a href="{{ route('tasks.create') }}" class="idx-add-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2" style="width:18px;height:18px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nouvelle Tâche
            </a>
        </div>

        {{-- Stats Cards --}}
        <div class="idx-stats">
            <div class="idx-stat-card done">
                <div>
                    <div class="idx-stat-label">Done</div>
                    <div class="idx-stat-num">{{ $counts['done'] }}</div>
                </div>
                <div class="idx-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="idx-stat-card todo">
                <div>
                    <div class="idx-stat-label">Todo</div>
                    <div class="idx-stat-num">{{ $counts['Todo'] }}</div>
                </div>
                <div class="idx-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
            </div>
            <div class="idx-stat-card progress">
                <div>
                    <div class="idx-stat-label">In Progress</div>
                    <div class="idx-stat-num">{{ $counts['in_progress'] }}</div>
                </div>
                <div class="idx-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Filter Bar --}}
        <form action="{{ route('tasks.index') }}" method="GET" class="idx-filter-bar">
            
            <select name="status" class="idx-filter-select">
                <option value="">Tous les statuts ▾</option>
                <option value="Todo" @selected(request('status') == 'Todo')>À faire</option>
                <option value="in progress" @selected(request('status') == 'in progress')>En cours</option>
                <option value="done" @selected(request('status') == 'done')>Terminé</option>
            </select>
            <select name="category_id" class="idx-filter-select">
                <option value="">Toutes les catégories ▾</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}
                    </option>
                @endforeach
            </select>
            <div class="idx-filter-actions">
                <button type="submit" class="idx-btn-filter">Filtrer</button>
                <a href="{{ route('tasks.index') }}" class="idx-btn-reset">Réinitialiser</a>
            </div>
        </form>

        {{-- Tasks Table --}}
        @if($tasks->isEmpty())
            <div class="idx-empty">Aucune tâche trouvée. Créez-en une !</div>
        @else
            <div class="idx-table-wrap">
                <table class="idx-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Statut</th>
                            <th>Catégorie</th>
                            <th>Date d'échéance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>
                                    <div class="idx-task-title">
                                        
                                        <span>{{ $task->title }}</span>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="idx-status-select {{ $task->status == 'Todo' ? 'status-todo' : ($task->status == 'in progress' ? 'status-progress' : 'status-done') }}">
                                            <option value="Todo" {{ $task->status == 'Todo' ? 'selected' : '' }}>Todo</option>
                                            <option value="in progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>In
                                                Progress</option>
                                            <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                                        </select>
                                        <input type="hidden" name="title" value="{{ $task->title }}">
                                        <input type="hidden" name="description" value="{{ $task->description }}">
                                        <input type="hidden" name="category_id" value="{{ $task->category_id }}">
                                    </form>
                                </td>
                                <td>
                                    <span class="idx-cat-badge">{{ $task->category->name }}</span>
                                </td>
                                <td>
                                    @if($task->due_date)
                                        @if($task->due_date->isPast() && $task->status !== 'done')
                                            <span class="idx-date-overdue">RETARD – {{ $task->due_date->format('d M') }}</span>
                                        @else
                                            <span class="idx-date">{{ $task->due_date->format('d M, Y') }}</span>
                                        @endif
                                    @else
                                        <span>X</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="idx-actions">
                                        <a href="{{ route('tasks.edit', $task) }}" class="idx-act-btn idx-act-edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Delete?')" class="idx-act-btn idx-act-del">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                {{-- <div class="idx-pagination-wrap">
                    <div class="idx-pagination-info">
                        Showing {{ $tasks->count() }} of {{ $tasks->total() }} tasks
                    </div>
                    {{ $tasks->withQueryString()->links() }}
                </div> --}}
            </div>
        @endif

        {{-- Footer --}}
        <div class="idx-footer">
            <p>&copy; {{ date('Y') }} Task Manager. Designed for tranquility.</p>
        </div>
    </div>

@endsection