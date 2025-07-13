<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Supply Chain Item Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('supply-chain.edit', $item) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Item
                </a>
                <a href="{{ route('supply-chain.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
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
                        <!-- Item Information -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Item Information</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Item Name</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $item->item_name }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ number_format($item->quantity) }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Supplier</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $item->supplier }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                            @php
                                                $statusColors = [
                                                    'ordered' => 'bg-blue-100 text-blue-800',
                                                    'in_transit' => 'bg-yellow-100 text-yellow-800',
                                                    'received' => 'bg-green-100 text-green-800',
                                                    'inspected' => 'bg-purple-100 text-purple-800',
                                                    'approved' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                    'returned' => 'bg-orange-100 text-orange-800',
                                                ];
                                                $statusColor = $statusColors[$item->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
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
                                            <label class="block text-sm font-medium text-gray-700">Received Date</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $item->received_date->format('F d, Y') }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Days Since Received</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                {{ $item->received_date->diffInDays(now()) }} days
                                            </p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Created</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $item->created_at->format('F d, Y \a\t g:i A') }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $item->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Notes</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $item->notes }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <form action="{{ route('supply-chain.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="return confirm('Are you sure you want to delete this item? This action cannot be undone.')">
                                Delete Item
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
