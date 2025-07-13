<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Production Batch Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('production.edit', $production) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('production.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
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
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Batch Information</h3>
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Batch Number</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $production->batch_number }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Product Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $production->product_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Production Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $production->production_date->format('F j, Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Quantity</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($production->quantity) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($production->status === 'completed') bg-green-100 text-green-800
                                            @elseif($production->status === 'in_progress') bg-yellow-100 text-yellow-800
                                            @elseif($production->status === 'cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $production->status)) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Operator</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $production->operator->name ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $production->created_at->format('F j, Y g:i A') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $production->updated_at->format('F j, Y g:i A') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Quality Control Records</h3>
                            @if($production->qualityControlRecords->count() > 0)
                                <div class="space-y-3">
                                    @foreach($production->qualityControlRecords as $qcRecord)
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        Inspection Date: {{ $qcRecord->inspection_date->format('M j, Y') }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        Inspector: {{ $qcRecord->inspector->name ?? 'N/A' }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        Result:
                                                        <span class="font-medium
                                                            @if($qcRecord->result === 'passed') text-green-600
                                                            @elseif($qcRecord->result === 'failed') text-red-600
                                                            @else text-yellow-600 @endif">
                                                            {{ ucfirst($qcRecord->result) }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            @if($qcRecord->notes)
                                                <p class="text-sm text-gray-600 mt-2">{{ $qcRecord->notes }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No quality control records found for this batch.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
