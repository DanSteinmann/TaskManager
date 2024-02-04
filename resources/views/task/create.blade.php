@extends('components.layout')
@section('content')
    <h1>New Task</h1>
    <form method="POST" action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}">
        @csrf
        @if(isset($task))
            @method('PUT')
        @endif

        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $task->title ?? '' }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ $task->description ?? '' }}</textarea>
        </div>

        <div>
            <label for="state">State:</label>
            <select id="state" name="state" required>
                <option value="0">Pending</option>
                <option value="1">Completed</option>
            </select>
        </div>

        <div>
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" value="{{ isset($task) ? $task->deadline : '' }}" required>
        </div>

        <div>
            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id">
        </div>

        <div>
            <label for="project_id">Project:</label>
            <select id="project_id" name="project_id">
                <option value="">Select a project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ (isset($task) && $task->project_id == $project->id) ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">{{ isset($task) ? 'Update' : 'Create' }}</button>
    </form>
@endsection