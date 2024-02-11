<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-4 border-grey-500/50 rounded-lg">
                <div class="p-4 font-bold text-center md:text-3xl text-gray-900">
                    <h1>New Task</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-4 border-grey-500/50 rounded-lg">
                <div class="p-4 font-bold md:text-3xl text-gray-900">
                    <form method="POST" action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}">
                        @csrf
                        @if(isset($task))
                            @method('PUT')
                        @endif

                        <div class="flex items-center py-2">
                            <label for="title" class="block w-40 text-xl md:text-2xl font-bold">Title:</label>
                            <input type="text" id="title" name="title" value="{{ $task->title ?? '' }}" required>
                        </div>

                        <div class="flex items-center py-2">
                            <label for="description" class="block w-40 text-xl md:text-2xl font-bold">Description:</label>
                            <textarea id="description" name="description" required>{{ $task->description ?? '' }}</textarea>
                        </div>

                        <div class="flex items-center py-2">
                            <label for="state" class="block w-40 text-xl md:text-2xl font-bold">State:</label>
                            <select id="state" name="state" required>
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>

                        <div class="flex items-center py-2">
                            <label for="deadline" class="block w-40 text-xl md:text-2xl font-bold">Deadline:</label>
                            <input type="date" id="deadline" name="deadline" value="{{ isset($task) ? $task->deadline : '' }}" required>
                        </div>

                        <div class="flex items-center py-2">
                        <label for="user_id" class="block w-40 text-xl md:text-2xl font-bold">User:</label>
                            <select id="user_id" name="user_id">
                                <option value ="">nobody</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ (isset($task) && $task->user_id == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center py-2">
                            <label for="project_id" class="block w-40 text-xl md:text-2xl font-bold">Project:</label>
                            <select id="project_id" name="project_id">
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ (isset($task) && $task->project_id == $project->id) ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="block w-24 px-4 py-2 bg-green-500 text-white text-xl rounded hover:bg-green-700">{{ isset($task) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>   
</x-app-layout>