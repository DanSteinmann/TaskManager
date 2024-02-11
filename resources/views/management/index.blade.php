<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-4 border-grey-500/50 rounded-lg">
                <div class="p-4 font-bold text-center md:text-3xl text-gray-900">
                    <h1>Task Management</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section>
                @if ($projects->isEmpty())
                    <div class="px-5 my-4 text-lg text-center text-gray-700">
                        <p>No projects available</p>
                        <form action="{{ route('projects.create') }}" method="GET">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-700">Create a new project</button>
                        </form>
                    </div>
                @else
                    @foreach ($projects as $project)
                    <div class="pb-5">
                        <div class="border-4 border-grey-500/50 rounded-lg" >
                            <div class="mx-auto">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="flex items-center justify-between text-gray-900">
                                        <p class="px-5 text-sm md:text-base">Start on: {{ $project->start_date }}</p>
                                        <h2 class="text-xl md:text-2xl font-bold text-center flex-1">{{ $project->name }}</h2>
                                        <p class="px-5 text-sm md:text-base">End on: {{ $project->end_date }}</p>
                                    </div>
                                    <div class="px-5 my-4 text-lg text-gray-500">
                                        <h2>Description: {{ $project->description }}</h2>
                                    </div>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-700">Delete project</button>
                                    </form>
                                    <form action="{{ route('projects.edit', $project->id) }}" method="GET" class="inline">
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-700">Edit project</button>
                                    </form>
                                </div>
                            </div>
                            @if ($project->tasks->isEmpty())

                                <div class="px-5 my-4 text-lg text-center text-gray-700">
                                    <p>no tasks assigned yet</p>
                                    <form action="{{ route('tasks.create') }}" method="GET">
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-700">Create a new task</button>
                                    </form>
                                </div>
                            @else
                                <table class="min-w-full divide-y divide-gray-200 mt-2">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/6">
                                                Title
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/4">
                                                Description
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/6">
                                                Deadline
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/6">
                                                User
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase w-1/4">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($project->tasks as $task)
                                            <tr class="bg-{{ $task->state ? 'grey-600' : 'white' }}">
                                                <td class="px-4 py-4 break-words">
                                                    {{ $task->title }}
                                                </td>
                                                <td class="px-4 py-4 break-words">
                                                    {{ $task->description }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    {{ $task->deadline }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap">
                                                    {{ $task->user ? $task->user->name : 'No user assigned' }}
                                                </td>
                                                <td>
                                                    <div class="flex items-center space-x-2">
                                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-700">Delete</button>
                                                        </form>
                                                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="change_state" value="1">
                                                            <button type="submit" class="px-4 py-2 bg-{{ $task->state ? 'blue-500' : 'green-500' }} text-white text-sm rounded hover:bg-{{ $task->state ? 'blue-700' : 'green-700' }}">{{ $task->state ? 'Redo' : 'Done' }}</button>
                                                        </form>
                                                        <form action="{{ route('tasks.edit', $task->id) }}" method="GET" class="inline">
                                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-700">Edit</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
            </section>
    </div>
</x-app-layout>