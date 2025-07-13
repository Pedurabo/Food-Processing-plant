<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Custom Reports') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('analytics.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Report Filters -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Generate Report</h3>
                    <form method="GET" action="{{ route('analytics.reports') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Report Type</label>
                            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="production" {{ $reportType === 'production' ? 'selected' : '' }}>Production Reports</option>
                                <option value="quality" {{ $reportType === 'quality' ? 'selected' : '' }}>Quality Control Reports</option>
                                <option value="maintenance" {{ $reportType === 'maintenance' ? 'selected' : '' }}>Maintenance Reports</option>
                                <option value="supply_chain" {{ $reportType === 'supply_chain' ? 'selected' : '' }}>Supply Chain Reports</option>
                            </select>
                        </div>

                        <div>
                            <label for="date_range" class="block text-sm font-medium text-gray-700">Date Range</label>
                            <select name="date_range" id="date_range" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="7" {{ $dateRange == 7 ? 'selected' : '' }}>Last 7 days</option>
                                <option value="30" {{ $dateRange == 30 ? 'selected' : '' }}>Last 30 days</option>
                                <option value="90" {{ $dateRange == 90 ? 'selected' : '' }}>Last 90 days</option>
                                <option value="180" {{ $dateRange == 180 ? 'selected' : '' }}>Last 6 months</option>
                                <option value="365" {{ $dateRange == 365 ? 'selected' : '' }}>Last year</option>
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Generate Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Report Results -->
            @if($data->count() > 0)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ ucfirst($reportType) }} Report (Last {{ $dateRange }} days)
                            </h3>
                            <div class="flex space-x-2">
                                <a href="{{ route('analytics.export', ['type' => $reportType, 'date_range' => $dateRange, 'format' => 'pdf']) }}"
                                   class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Export PDF
                                </a>
                                <a href="{{ route('analytics.export', ['type' => $reportType, 'date_range' => $dateRange, 'format' => 'excel']) }}"
                                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Export Excel
                                </a>
                            </div>
                        </div>

                        <!-- Report Summary -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-blue-600">Total Records</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $data->count() }}</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-green-600">Date Range</p>
                                <p class="text-lg font-semibold text-green-900">{{ \Carbon\Carbon::now()->subDays($dateRange)->format('M d, Y') }} - {{ \Carbon\Carbon::now()->format('M d, Y') }}</p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-purple-600">Report Type</p>
                                <p class="text-lg font-semibold text-purple-900">{{ ucfirst(str_replace('_', ' ', $reportType)) }}</p>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="overflow-x-auto">
                            @if($reportType === 'production')
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch Number</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operator</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($data as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->batch_number }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->product_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $item->status === 'completed' ? 'bg-green-100 text-green-800' :
                                                           ($item->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->operator->name ?? 'Unknown' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($reportType === 'quality')
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inspection Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Result</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inspector</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($data as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->inspection_type }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $item->result === 'passed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ ucfirst($item->result) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->inspector->name ?? 'Unknown' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($reportType === 'maintenance')
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Equipment</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Technician</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($data as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->equipment_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($item->type) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $item->status === 'completed' ? 'bg-green-100 text-green-800' :
                                                           ($item->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->technician->name ?? 'Unknown' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif($reportType === 'supply_chain')
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Received</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($data as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->item_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($item->quantity) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->supplier }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $item->status === 'received' ? 'bg-green-100 text-green-800' :
                                                           ($item->status === 'in_transit' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->received_date->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No data found</h3>
                        <p class="mt-1 text-sm text-gray-500">No records found for the selected criteria.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
