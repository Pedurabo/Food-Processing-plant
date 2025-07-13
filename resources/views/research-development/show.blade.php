<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Research & Development Project Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('research-development.edit', $project) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Project
                </a>
                <a href="{{ route('research-development.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Project Information -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Project Information</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Project Name</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $project->project_name }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Lead Researcher</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $project->leadResearcher->name }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                            @php
                                                $statusColors = [
                                                    'planning' => 'bg-gray-100 text-gray-800',
                                                    'in_progress' => 'bg-blue-100 text-blue-800',
                                                    'testing' => 'bg-yellow-100 text-yellow-800',
                                                    'completed' => 'bg-green-100 text-green-800',
                                                    'on_hold' => 'bg-orange-100 text-orange-800',
                                                    'cancelled' => 'bg-red-100 text-red-800',
                                                ];
                                                $statusColor = $statusColors[$project->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Information -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Timeline</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Start Date</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $project->start_date->format('F d, Y') }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">End Date</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $project->end_date ? $project->end_date->format('F d, Y') : 'Ongoing' }}
                                            </p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Duration</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                @if($project->end_date)
                                                    {{ $project->start_date->diffInDays($project->end_date) }} days
                                                @else
                                                    {{ $project->start_date->diffInDays(now()) }} days (ongoing)
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Project Description</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $project->description }}</p>
                        </div>
                    </div>

                    <!-- Project Details -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Project Details</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Created</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $project->created_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $project->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <form action="{{ route('research-development.destroy', $project) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="return confirm('Are you sure you want to delete this project? This action cannot be undone.')">
                                Delete Project
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
