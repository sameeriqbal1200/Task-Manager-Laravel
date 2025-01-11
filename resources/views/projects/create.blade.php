@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Project</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Create Project</button>
    </form>
</div>
@endsection