<!--
    This page is for maintenance only, it display all tasks
-->
<div>
    <section class="main">
        @if ($tasks->isEmpty())
            <p>No tasks available</p>
        @else
            <table>
                <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Deadline</td>
                    <td>Actions</td>
                </tr>
                @foreach ($tasks as $task)    
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
                    </tr>
                @endforeach
            </table>
        @endif
    </section>
</div>