    <aside class="w-64 bg-white shadow-lg p-5">
        <h1 class="text-2xl font-bold mb-6">Tasks App</h1>

        <nav class="space-y-3">

            <a href="{{ route('tasks.index') }}"
               class="block text-gray-700 hover:text-blue-600">
                📋 Tasks
            </a>

            <a href="{{ route('tasks.create') }}"
               class="block text-gray-700 hover:text-blue-600">
                ➕ Add Task
            </a>

        </nav>
    </aside>