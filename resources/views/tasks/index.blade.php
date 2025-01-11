@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        Task List for Project: {{ $projectId ? $projects->find($projectId)->name : 'All Projects' }}
    </h1>

    <!-- Buttons for Navigation -->
    <div class="mb-3">
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
        <a href="{{ route('tasks.create', ['project_id' => $projectId]) }}" class="btn btn-primary">Create Task</a>
    </div>

    <!-- Task List -->
    <ul id="task-list" class="list-group">
        @foreach($tasks as $task)
            <li class="list-group-item" data-id="{{ $task->id }}">
                {{ $task->name }} - Priority: {{ $task->priority }}
            </li>
        @endforeach
    </ul>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    // Initialize Sortable
    const taskList = document.getElementById('task-list');
    const sortable = new Sortable(taskList, {
        animation: 150,
        onEnd: function (evt) {
            // Gather the new order of task IDs
            const reorderedTaskIds = Array.from(taskList.children).map(item => item.dataset.id);
            console.log('reorderedTaskIds', reorderedTaskIds)
            // Send the new order to the server
            fetch('{{ route('tasks.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ order: reorderedTaskIds }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to save new order');
                }
                return response.json();
            })
            .then(data => {
                alert('Task order updated successfully!');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating task order.');
            });
        },
    });
</script>
@endsection