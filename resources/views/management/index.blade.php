@extends('components.layout')
@section('content')
<div class="button-group">
    <form action="{{ route('tasks.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">New Task</button>
    </form>
    <form action="{{ route('projects.create') }}" method="GET">
        <button type="submit" class="btn btn-primary">New Project</button>
    </form>
</div>

<div>
    <section class="main">
        @if ($projects->isEmpty())
            <p>No projects available</p>
        @else
            @foreach ($projects as $project)
                <div class="projectTitle">
                    <label>{{ $project->name }}</label>
                </div>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <p>{{ $project->description }}</p>
                @if ($project->tasks->isEmpty())
                    <p>No tasks available</p>
                @else
                    <table>
                        <tr>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Deadline</td>
                            <td>Actions</td>
                        </tr>
                        @foreach ($project->tasks as $task)
                            <tr class="tasks-list">
                                <td>
                                    <div class="view">
                                        <label>{{ $task->title }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="view">
                                        <label>{{ $task->description }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="view">
                                        <label>{{ $task->deadline }}</label>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="change_state" value="1">
                                        <button type="submit" class="btn btn-{{ $task->state ? 'success' : 'secondary' }}">{{ $task->state ? 'Complete' : 'Incomplete' }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('tasks.edit', $task->id) }}" method="GET">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            @endforeach
        @endif
    </section>
</div>
@endsection