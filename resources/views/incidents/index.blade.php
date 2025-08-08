@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 code-font">Incident Reports</h1>
                <p class="text-gray-600 mt-1">Track and manage student discipline incidents</p>
            </div>
            <a href="{{ route('incidents.create') }}" 
               class="glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Report Incident
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="mb-8">
        <form action="{{ route('incidents.index') }}" method="GET" class="flex gap-4">
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
                           placeholder="Search incidents by student name or description..."
                           class="w-full pl-10 pr-4 py-3 border-0 rounded-xl shadow-lg focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 glass-effect">
                </div>
            </div>
            <button type="submit" 
                    class="glass-effect hover:glow-effect text-gray-700 hover:text-blue-600 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Search
            </button>
        </form>
    </div>

    <!-- Incidents List -->
    <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
        <div class="px-6 py-8">
            @if($incidents->count() > 0)
                <!-- Group incidents by date -->
                @php
                    $groupedIncidents = $incidents->groupBy(function($incident) {
                        $date = $incident->created_at;
                        if ($date->isToday()) return 'Today';
                        if ($date->isYesterday()) return 'Yesterday';
                        if ($date->weekOfYear === now()->weekOfYear && $date->year === now()->year) return 'This Week';
                        if ($date->month === now()->month && $date->year === now()->year) return 'This Month';
                        return 'Older';
                    });
                @endphp

                <div class="space-y-8">
                    @foreach($groupedIncidents as $dateGroup => $dateIncidents)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 code-font">{{ $dateGroup }}</h3>
                            <div class="space-y-4">
                                @foreach($dateIncidents as $incident)
                                    <div class="glass-effect border border-white/20 rounded-xl p-4 hover:shadow-lg transition-all duration-200 cursor-pointer"
                                         onclick="window.location.href='{{ route('incidents.show', $incident) }}'">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <!-- Student Avatar -->
                                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                                    <span class="text-white font-bold text-lg code-font">
                                                        {{ strtoupper(substr($incident->student->first_name, 0, 1) . substr($incident->student->last_name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                
                                                <div>
                                                    <h4 class="text-lg font-semibold text-gray-900">{{ $incident->student->full_name }}</h4>
                                                    <p class="text-sm text-gray-600">Grade {{ $incident->student->grade }} • {{ $incident->incidentType->name }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center space-x-3">
                                                <!-- Status and Severity -->
                                                <div class="flex items-center space-x-2">
                                                    @if($incident->status === 'open')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            <div class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1"></div>
                                                            Open
                                                        </span>
                                                    @elseif($incident->status === 'resolved')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1"></div>
                                                            Resolved
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1"></div>
                                                            Escalated
                                                        </span>
                                                    @endif
                                                    
                                                    @if($incident->severity === 'critical')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            Critical
                                                        </span>
                                                    @elseif($incident->severity === 'major')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                            Major
                                                        </span>
                                                    @elseif($incident->severity === 'moderate')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            Moderate
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                            Minor
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <!-- Time and Actions -->
                                                <div class="flex items-center space-x-3">
                                                    <div class="text-right">
                                                        <div class="text-xs text-gray-500">{{ $incident->created_at->format('M j, g:i A') }}</div>
                                                        <div class="text-xs text-gray-400">by {{ $incident->reportedBy->name ?? 'Unknown' }}</div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="glass-effect text-blue-600 p-2 rounded-lg">
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
                
                <!-- Pagination -->
                @if($incidents->hasPages())
                    <div class="mt-8">
                        {{ $incidents->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No incidents found</h3>
                    <p class="text-gray-600 mb-8">Get started by reporting your first incident.</p>
                    <a href="{{ route('incidents.create') }}" 
                       class="glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Report Incident
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 