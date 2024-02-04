@extends('components.layout')
@section('content')
    <h1>New Project</h1>
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div>
            <label for="start_date">Start date:</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>

        <div>
            <label for="end_date">End date:</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>

        <input type="submit" value="Create project">
    </form>
@endsection