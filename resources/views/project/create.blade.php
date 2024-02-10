@extends('components.layout')
@section('content')
    <h1>New Project</h1>
    <form method="POST" action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}">
        @csrf
        @if(isset($project))
            @method('PUT')
        @endif

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $project->name ?? '' }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ $project->description ?? '' }}</textarea>
        </div>

        <div>
            <label for="start_date">Start date:</label>
            <input type="date" id="start_date" name="start_date" value="{{ isset($project) ? $project->start_date : '' }}" required>
        </div>

        <div>
            <label for="end_date">End date:</label>
            <input type="date" id="end_date" name="end_date" value="{{ isset($project) ? $project->end_date : '' }}" required>
        </div>

        <button type="submit">{{ isset($project) ? 'Update' : 'Create' }}</button>
    </form>
@endsection