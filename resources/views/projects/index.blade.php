@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Projects</h1>

    @if($projects->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Task</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>
                            <a href="{{ route('tasks.index', ['project_id' => $project->id]) }}" class="btn btn-primary">View Tasks</a>
                        </td>
                        <td>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No projects found.</p>
    @endif

    <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
</div>
@endsection