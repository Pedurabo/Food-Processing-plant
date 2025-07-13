<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Research & Development Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('research-development.update', $project) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Project Name -->
                            <div>
                                <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
                                <input type="text" name="project_name" id="project_name" value="{{ old('project_name', $project->project_name) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('project_name') border-red-500 @enderror" required>
                                @error('project_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Lead Researcher -->
                            <div>
                                <label for="lead_researcher_id" class="block text-sm font-medium text-gray-700">Lead Researcher</label>
                                <select name="lead_researcher_id" id="lead_researcher_id"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('lead_researcher_id') border-red-500 @enderror" required>
                                    <option value="">Select a researcher</option>
                                    @foreach($researchers as $researcher)
                                        <option value="{{ $researcher->id }}" {{ old('lead_researcher_id', $project->lead_researcher_id) == $researcher->id ? 'selected' : '' }}>
                                            {{ $researcher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lead_researcher_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('start_date') border-red-500 @enderror" required>
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date (Optional)</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('end_date') border-red-500 @enderror">
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('status') border-red-500 @enderror" required>
                                    <option value="">Select status</option>
                                    @foreach($statusOptions as $value => $label)
                                        <option value="{{ $value }}" {{ old('status', $project->status) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('description') border-red-500 @enderror"
                                      placeholder="Describe the research project, objectives, methodology, and expected outcomes..." required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('research-development.index') }}"
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
