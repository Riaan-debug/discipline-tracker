@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 code-font">Dashboard</h1>
        <p class="text-gray-600 mt-2">Overview of your discipline tracking system</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Students -->
        <div class="glass-effect shadow-xl rounded-2xl p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Students</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>

        <!-- Active Incidents -->
        <div class="glass-effect shadow-xl rounded-2xl p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Incidents</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $activeIncidents }}</p>
                </div>
            </div>
        </div>

        <!-- Total Incidents -->
        <div class="glass-effect shadow-xl rounded-2xl p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Incidents</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalIncidents }}</p>
                </div>
            </div>
        </div>

        <!-- Positive Reports -->
        <div class="glass-effect shadow-xl rounded-2xl p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Positive Reports</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPositiveReports }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('students.create') }}" class="glass-effect shadow-xl rounded-2xl p-6 hover:shadow-2xl transition-all duration-200 hover:scale-[1.02]">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Add Student</h3>
                        <p class="text-gray-600">Register a new student</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('incidents.create') }}" class="glass-effect shadow-xl rounded-2xl p-6 hover:shadow-2xl transition-all duration-200 hover:scale-[1.02]">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Report Incident</h3>
                        <p class="text-gray-600">Log a behavioral incident</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('positive-reports.create') }}" class="glass-effect shadow-xl rounded-2xl p-6 hover:shadow-2xl transition-all duration-200 hover:scale-[1.02]">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Add Positive Report</h3>
                        <p class="text-gray-600">Record student achievement</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Incidents -->
        <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-red-50 to-orange-50 border-b border-white/20">
                <h3 class="text-lg font-semibold text-gray-900">Recent Incidents</h3>
            </div>
            <div class="p-6">
                @if($recentIncidents->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentIncidents as $incident)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $incident->student->full_name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $incident->incidentType->name }} • {{ $incident->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No recent incidents</p>
                @endif
            </div>
        </div>

        <!-- Recent Positive Reports -->
        <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-white/20">
                <h3 class="text-lg font-semibold text-gray-900">Recent Positive Reports</h3>
            </div>
            <div class="p-6">
                @if($recentPositiveReports->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentPositiveReports as $report)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $report->student->full_name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $report->positiveReportType->name }} • {{ $report->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No recent positive reports</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Grade Statistics -->
    @if($incidentsByGrade->count() > 0)
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Incidents by Grade</h2>
            <div class="glass-effect shadow-xl rounded-2xl p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($incidentsByGrade as $grade => $count)
                        <div class="text-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <span class="text-white font-bold text-sm">{{ $grade }}</span>
                            </div>
                            <p class="text-lg font-semibold text-gray-900">{{ $count }}</p>
                            <p class="text-xs text-gray-500">incidents</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection 