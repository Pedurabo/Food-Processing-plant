<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Analytics Dashboard') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('analytics.reports') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Custom Reports
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Key Performance Indicators -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Production KPI -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Production Completion</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $data['productionStats']['completion_rate'] }}%</p>
                                <p class="text-xs text-gray-500">{{ $data['productionStats']['completed_batches'] }} of {{ $data['productionStats']['total_batches'] }} batches</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quality KPI -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Quality Pass Rate</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $data['qualityStats']['pass_rate'] }}%</p>
                                <p class="text-xs text-gray-500">{{ $data['qualityStats']['passed_inspections'] }} of {{ $data['qualityStats']['total_inspections'] }} inspections</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maintenance KPI -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Maintenance Completion</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $data['maintenanceStats']['completion_rate'] }}%</p>
                                <p class="text-xs text-gray-500">{{ $data['maintenanceStats']['completed_maintenance'] }} of {{ $data['maintenanceStats']['total_maintenance'] }} tasks</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- R&D KPI -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">R&D Completion</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $data['rdStats']['completion_rate'] }}%</p>
                                <p class="text-xs text-gray-500">{{ $data['rdStats']['completed_projects'] }} of {{ $data['rdStats']['total_projects'] }} projects</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Trends -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Monthly Trends Chart -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Activity Trends</h3>
                        <div class="h-64 flex items-end justify-between space-x-2">
                            @php
                                $months = collect();
                                for ($i = 5; $i >= 0; $i--) {
                                    $months->push(Carbon\Carbon::now()->subMonths($i)->format('M'));
                                }
                                $maxValue = max(
                                    max(array_values($data['monthlyTrends']['production'] ?? [])),
                                    max(array_values($data['monthlyTrends']['quality'] ?? [])),
                                    max(array_values($data['monthlyTrends']['maintenance'] ?? []))
                                );
                            @endphp

                            @foreach($months as $index => $month)
                                <div class="flex flex-col items-center space-y-2">
                                    <div class="flex space-x-1">
                                        @php
                                            $productionValue = $data['monthlyTrends']['production'][$month] ?? 0;
                                            $qualityValue = $data['monthlyTrends']['quality'][$month] ?? 0;
                                            $maintenanceValue = $data['monthlyTrends']['maintenance'][$month] ?? 0;
                                        @endphp

                                        <div class="w-4 bg-blue-500 rounded-t" style="height: {{ $maxValue > 0 ? ($productionValue / $maxValue) * 200 : 0 }}px;"></div>
                                        <div class="w-4 bg-green-500 rounded-t" style="height: {{ $maxValue > 0 ? ($qualityValue / $maxValue) * 200 : 0 }}px;"></div>
                                        <div class="w-4 bg-yellow-500 rounded-t" style="height: {{ $maxValue > 0 ? ($maintenanceValue / $maxValue) * 200 : 0 }}px;"></div>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $month }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-center space-x-4 mt-4">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded mr-2"></div>
                                <span class="text-xs text-gray-600">Production</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded mr-2"></div>
                                <span class="text-xs text-gray-600">Quality</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded mr-2"></div>
                                <span class="text-xs text-gray-600">Maintenance</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supply Chain Status -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Supply Chain Status</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Total Items</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $data['supplyChainStats']['total_items'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Received</span>
                                <span class="text-lg font-semibold text-green-600">{{ $data['supplyChainStats']['received_items'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">In Transit</span>
                                <span class="text-lg font-semibold text-yellow-600">{{ $data['supplyChainStats']['in_transit_items'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Approved</span>
                                <span class="text-lg font-semibold text-blue-600">{{ $data['supplyChainStats']['approved_items'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        @forelse($data['recentActivity'] as $activity)
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    @if($activity['type'] === 'production')
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                    @elseif($activity['type'] === 'quality')
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    @elseif($activity['type'] === 'maintenance')
                                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $activity['title'] }}</p>
                                    <p class="text-sm text-gray-500">{{ $activity['description'] }}</p>
                                    <p class="text-xs text-gray-400">{{ $activity['date']->diffForHumans() }} by {{ $activity['operator'] ?? $activity['inspector'] ?? $activity['technician'] ?? 'Unknown' }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No recent activity found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
