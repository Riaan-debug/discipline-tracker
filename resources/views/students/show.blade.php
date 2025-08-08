@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center">
                    <span class="text-white font-bold text-2xl code-font">
                        {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                    </span>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 code-font">{{ $student->full_name }}</h1>
                    <p class="text-gray-600 mt-1">Grade {{ $student->grade }} • Student Profile</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('positive-reports.create', ['student_id' => $student->id]) }}" 
                   class="glass-effect hover:glow-effect text-green-600 hover:text-green-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    Add Positive Report
                </a>
                <a href="{{ route('incidents.create', ['student_id' => $student->id]) }}" 
                   class="glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Report Incident
                </a>
                <a href="{{ route('students.edit', $student) }}" 
                   class="glass-effect hover:glow-effect text-gray-700 hover:text-blue-600 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Student
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Student Information -->
        <div class="lg:col-span-1">
            <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
                <div class="px-6 py-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6 code-font">Student Information</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Contact Details</h4>
                            <div class="space-y-3">
                                @if($student->email)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">{{ $student->email }}</span>
                                    </div>
                                @endif
                                @if($student->parent_name)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">{{ $student->parent_name }}</span>
                                    </div>
                                @endif
                                @if($student->parent_email)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">{{ $student->parent_email }}</span>
                                    </div>
                                @endif
                                @if($student->parent_phone)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">{{ $student->parent_phone }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Status</h4>
                            <div class="flex items-center space-x-3">
                                @if($student->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 status-badge">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <div class="w-2 h-2 bg-gray-500 rounded-full mr-2"></div>
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($student->notes)
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Notes</h4>
                                <p class="text-sm text-gray-700 bg-gray-50 rounded-lg p-3">{{ $student->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Timeline -->
        <div class="lg:col-span-2">
            <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
                <div class="px-6 py-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 code-font">Recent Activity</h3>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full {{ $student->active_incidents_count > 0 ? 'bg-red-500' : 'bg-green-500' }} mr-2"></div>
                                <span class="text-sm text-gray-600">
                                    Incidents: <span class="font-semibold {{ $student->active_incidents_count > 0 ? 'text-red-600' : 'text-green-600' }}">{{ $student->active_incidents_count }}</span>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                <span class="text-sm text-gray-600">
                                    Positive: <span class="font-semibold text-green-600">{{ $student->positiveReports->count() }}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    @php
                        // Combine incidents and positive reports, sort by date
                        $allActivities = collect();
                        
                        // Add incidents
                        foreach($student->incidents as $incident) {
                            $allActivities->push([
                                'type' => 'incident',
                                'data' => $incident,
                                'date' => $incident->created_at
                            ]);
                        }
                        
                        // Add positive reports
                        foreach($student->positiveReports as $report) {
                            $allActivities->push([
                                'type' => 'positive_report',
                                'data' => $report,
                                'date' => $report->created_at
                            ]);
                        }
                        
                        // Sort by date (newest first) and group
                        $groupedActivities = $allActivities->sortByDesc('date')->groupBy(function($activity) {
                            $date = $activity['date'];
                            if ($date->isToday()) return 'Today';
                            if ($date->isYesterday()) return 'Yesterday';
                            if ($date->weekOfYear === now()->weekOfYear && $date->year === now()->year) return 'This Week';
                            if ($date->month === now()->month && $date->year === now()->year) return 'This Month';
                            return 'Older';
                        });
                    @endphp

                    @if($allActivities->count() > 0)
                        <div class="space-y-6">
                            @foreach($groupedActivities as $dateGroup => $activities)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-3 uppercase tracking-wide">{{ $dateGroup }}</h4>
                                    <div class="space-y-3">
                                        @foreach($activities as $activity)
                                            @if($activity['type'] === 'incident')
                                                @php $incident = $activity['data']; @endphp
                                                <div class="glass-effect border border-white/20 rounded-xl p-4 hover:shadow-lg transition-all duration-200 cursor-pointer"
                                                     onclick="window.location.href='{{ route('incidents.show', $incident) }}'">
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-3">
                                                            <!-- Incident Type Icon -->
                                                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-500 rounded-xl flex items-center justify-center">
                                                                @if($incident->incidentType->name == 'Drug Use')
                                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                                                    </svg>
                                                                @elseif($incident->incidentType->name == 'Fighting')
                                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path>
                                                                    </svg>
                                                                @elseif($incident->incidentType->name == 'Truancy')
                                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                    </svg>
                                                                @else
                                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                                    </svg>
                                                                @endif
                                                            </div>
                                                            
                                                            <div>
                                                                <h4 class="text-lg font-semibold text-gray-900">{{ $incident->incidentType->name }}</h4>
                                                                <div class="flex items-center space-x-2 mt-1">
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
                                                            </div>
                                                        </div>
                                                        
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
                                            @else
                                                @php $report = $activity['data']; @endphp
                                                <div class="glass-effect border border-white/20 rounded-xl p-4 hover:shadow-lg transition-all duration-200 cursor-pointer"
                                                     onclick="window.location.href='{{ route('positive-reports.show', $report) }}'">
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-3">
                                                            <!-- Positive Report Icon -->
                                                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                                                                <span class="text-2xl">{{ $report->positiveReportType->icon }}</span>
                                                            </div>
                                                            
                                                            <div>
                                                                <h4 class="text-lg font-semibold text-gray-900">{{ $report->positiveReportType->name }}</h4>
                                                                <p class="text-sm text-green-700 mt-1">{{ Str::limit($report->description, 60) }}</p>
                                                            </div>
                                                        </div>
                                                        
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
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No activity yet</h3>
                            <p class="text-gray-600 mb-6">This student has no incidents or positive reports recorded.</p>
                            <div class="flex items-center justify-center space-x-4">
                                <a href="{{ route('positive-reports.create', ['student_id' => $student->id]) }}" 
                                   class="glass-effect hover:glow-effect text-green-600 hover:text-green-700 font-medium py-2 px-4 rounded-lg transition-all duration-200 inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    Add Positive Report
                                </a>
                                <a href="{{ route('incidents.create', ['student_id' => $student->id]) }}" 
                                   class="glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-2 px-4 rounded-lg transition-all duration-200 inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Report Incident
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 