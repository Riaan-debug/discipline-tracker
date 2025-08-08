@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 code-font">🌟 Positive Reports</h1>
                <p class="text-gray-600 mt-1">Celebrating student achievements and good behavior</p>
            </div>
            <a href="{{ route('positive-reports.create') }}" 
               class="glass-effect hover:glow-effect text-green-600 hover:text-green-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Positive Report
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="mb-8">
        <form action="{{ route('positive-reports.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search positive reports by student name or description..."
                           class="w-full pl-10 pr-4 py-3 border-0 rounded-xl shadow-lg focus:ring-2 focus:ring-green-500 focus:ring-offset-2 glass-effect">
                </div>
            </div>
            <button type="submit" 
                    class="glass-effect hover:glow-effect text-gray-700 hover:text-green-600 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Search
            </button>
        </form>
    </div>

    <!-- Positive Reports List -->
    <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
        <div class="px-6 py-8">
            @if($groupedReports->count() > 0)
                <div class="space-y-8">
                    @foreach($groupedReports as $dateGroup => $reports)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 code-font">{{ $dateGroup }}</h3>
                            <div class="space-y-4">
                                @foreach($reports as $report)
                                    <div class="glass-effect border border-white/20 rounded-xl p-4 hover:shadow-lg transition-all duration-200 cursor-pointer"
                                         onclick="window.location.href='{{ route('positive-reports.show', $report) }}'">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <!-- Student Avatar -->
                                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                                                    <span class="text-white font-bold text-lg code-font">
                                                        {{ strtoupper(substr($report->student->first_name, 0, 1) . substr($report->student->last_name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                
                                                <div>
                                                    <h4 class="text-lg font-semibold text-gray-900">{{ $report->student->full_name }}</h4>
                                                    <p class="text-sm text-gray-600">Grade {{ $report->student->grade }} • {{ $report->positiveReportType->name }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center space-x-3">
                                                <!-- Report Type Badge -->
                                                <div class="flex items-center space-x-2">
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1"></div>
                                                        {{ $report->positiveReportType->name }}
                                                    </span>
                                                </div>
                                                
                                                <!-- Time and Actions -->
                                                <div class="flex items-center space-x-3">
                                                    <div class="text-right">
                                                        <div class="text-xs text-gray-500">{{ $report->created_at->format('M j, g:i A') }}</div>
                                                        <div class="text-xs text-gray-400">by {{ $report->reportedBy->name ?? 'Unknown' }}</div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="glass-effect text-green-600 p-2 rounded-lg">
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                

            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No positive reports found</h3>
                    <p class="text-gray-600 mb-8">Get started by creating your first positive report.</p>
                    <a href="{{ route('positive-reports.create') }}" 
                       class="glass-effect hover:glow-effect text-green-600 hover:text-green-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Positive Report
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 