<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Maintenance Record Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('maintenance.edit', $maintenance) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('maintenance.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Maintenance Information</h3>
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Equipment Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $maintenance->equipment_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Maintenance Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $maintenance->maintenance_date->format('F j, Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Performed By</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $maintenance->performedBy->name ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($maintenance->status === 'completed') bg-green-100 text-green-800
                                            @elseif($maintenance->status === 'in_progress') bg-yellow-100 text-yellow-800
                                            @elseif($maintenance->status === 'scheduled') bg-blue-100 text-blue-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                                        </span>
                                    </dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $maintenance->description }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $maintenance->created_at->format('F j, Y g:i A') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $maintenance->updated_at->format('F j, Y g:i A') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Maintenance History</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-sm text-gray-600">
                                    This maintenance record was created on {{ $maintenance->created_at->format('F j, Y') }}
                                    and is currently {{ str_replace('_', ' ', $maintenance->status) }}.
                                </p>

                                @if($maintenance->status === 'scheduled')
                                    <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                                        <p class="text-sm text-blue-800">
                                            <strong>Next Steps:</strong> This maintenance is scheduled for {{ $maintenance->maintenance_date->format('F j, Y') }}.
                                        </p>
                                    </div>
                                @elseif($maintenance->status === 'in_progress')
                                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                                        <p class="text-sm text-yellow-800">
                                            <strong>Status:</strong> Maintenance work is currently in progress.
                                        </p>
                                    </div>
                                @elseif($maintenance->status === 'completed')
                                    <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-md">
                                        <p class="text-sm text-green-800">
                                            <strong>Status:</strong> Maintenance has been completed successfully.
                                        </p>
                                    </div>
                                @elseif($maintenance->status === 'cancelled')
                                    <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-md">
                                        <p class="text-sm text-red-800">
                                            <strong>Status:</strong> This maintenance has been cancelled.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
