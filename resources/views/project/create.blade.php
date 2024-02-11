<x-app-layout>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-4 border-grey-500/50 rounded-lg">
                <div class="p-4 font-bold text-center md:text-3xl text-gray-900">
                    <h1>New Project</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-4 border-grey-500/50 rounded-lg">
                <div class="p-4 font-bold md:text-3xl text-gray-900">
                    <form method="POST" action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}">
                        @csrf
                        @if(isset($project))
                            @method('PUT')
                        @endif

                        <div class="flex items-center py-2">
                            <label for="name" class="block w-40 text-xl md:text-2xl font-bold">Name:</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $project->name ?? '') }}" required>
                        </div>

                        <div class="flex items-center py-2">
                            <label for="description" class="block w-40 text-xl md:text-2xl font-bold">Description:</label>
                            <textarea id="description" name="description" required>{{ old('name', $project->description ?? '') }}</textarea>
                        </div>

                        <div class="flex items-center py-2">
                            <label for="start_date" class="block w-40 text-xl md:text-2xl font-bold">Start date:</label>
                            <input type="date" id="start_date" name="start_date" value="{{ isset($project) ? $project->start_date : '' }}" required>
                        </div>

                        <div class="flex items-center py-2">
                            <label for="end_date" class="block w-40 text-xl md:text-2xl font-bold">End date:</label>
                            <input type="date" id="end_date" name="end_date" value="{{ isset($project) ? $project->end_date : '' }}" required>
                        </div>

                        <button type="submit" class="block w-24 px-4 py-2 bg-green-500 text-white text-xl rounded hover:bg-green-700">{{ isset($project) ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>