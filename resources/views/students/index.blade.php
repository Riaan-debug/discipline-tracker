@extends('layouts.app')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 code-font">Student Directory</h1>
                <p class="text-gray-600 mt-1">
                    {{ $filteredCount }} of {{ $totalStudents }} students
                    @if($filteredCount !== $totalStudents)
                        <span class="text-blue-600">(filtered)</span>
                    @endif
                </p>
            </div>
            <div class="flex items-center space-x-4" x-data="{ showExportOptions: false }">
                <div class="relative">
                    <button @click="showExportOptions = !showExportOptions" 
                            class="glass-effect hover:glow-effect text-green-600 hover:text-green-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="showExportOptions" @click.away="showExportOptions = false" x-transition 
                         class="absolute right-0 mt-2 w-48 glass-effect rounded-xl shadow-lg py-2 z-50">
                        <a href="{{ secure_url(route('students.export', array_merge(request()->query(), ['format' => 'excel']), false)) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Excel (.xlsx)
                        </a>
                        <a href="{{ secure_url(route('students.export', array_merge(request()->query(), ['format' => 'pdf']), false)) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            PDF Report
                        </a>
                        <a href="{{ secure_url(route('students.export', array_merge(request()->query(), ['format' => 'csv']), false)) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            CSV File
                        </a>

                    </div>
                </div>
                <a href="{{ route('students.create') }}" 
                   class="glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Student
                </a>
            </div>
        </div>
    </div>

    <!-- Advanced Search & Filters -->
    <div class="mb-8" x-data="{ showFilters: false }">
        <form action="{{ route('students.index') }}" method="GET" class="space-y-6">
            <!-- Main Search Row -->
            <div class="flex gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="q" 
                               value="{{ $query ?? '' }}"
                               placeholder="Search by name, email, parent, phone, or notes..." 
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
                <button type="button" 
                        @click="showFilters = !showFilters"
                        class="glass-effect hover:glow-effect text-gray-700 hover:text-purple-600 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                    </svg>
                    Filters
                </button>
                @if(request()->hasAny(['q', 'grade', 'has_incidents', 'status', 'date_from', 'date_to', 'incident_type', 'severity']))
                    <a href="{{ route('students.index') }}" 
                       class="glass-effect hover:glow-effect text-gray-700 hover:text-red-600 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear All
                    </a>
                @endif
            </div>
            
            <!-- Advanced Filters -->
            <div x-show="showFilters" x-transition class="glass-effect shadow-xl rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Advanced Filters</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Grade Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Grade</label>
                        <select name="grade" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all">All Grades</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade }}" {{ $gradeFilter == $grade ? 'selected' : '' }}>
                                    Grade {{ $grade }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all">All Students</option>
                            <option value="active" {{ $statusFilter == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $statusFilter == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    
                    <!-- Incident Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Incident Status</label>
                        <select name="has_incidents" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all">All Students</option>
                            <option value="with_incidents" {{ $incidentFilter == 'with_incidents' ? 'selected' : '' }}>With Any Incidents</option>
                            <option value="with_active_incidents" {{ $incidentFilter == 'with_active_incidents' ? 'selected' : '' }}>With Active Incidents</option>
                            <option value="with_resolved_incidents" {{ $incidentFilter == 'with_resolved_incidents' ? 'selected' : '' }}>With Resolved Incidents</option>
                            <option value="with_escalated_incidents" {{ $incidentFilter == 'with_escalated_incidents' ? 'selected' : '' }}>With Escalated Incidents</option>
                            <option value="without_incidents" {{ $incidentFilter == 'without_incidents' ? 'selected' : '' }}>Without Incidents</option>
                        </select>
                    </div>
                    
                    <!-- Incident Type Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Incident Type</label>
                        <select name="incident_type" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all">All Types</option>
                            @foreach($incidentTypes as $type)
                                <option value="{{ $type->id }}" {{ $incidentTypeFilter == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Severity Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Severity</label>
                        <select name="severity" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all">All Severities</option>
                            @foreach($severities as $severity)
                                <option value="{{ $severity }}" {{ $severityFilter == $severity ? 'selected' : '' }}>
                                    {{ ucfirst($severity) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Date Range -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                        <input type="date" name="date_from" value="{{ $dateFrom }}" 
                               class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                        <input type="date" name="date_to" value="{{ $dateTo }}" 
                               class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <!-- Sort Options -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                        <select name="sort_by" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="last_name" {{ $sortBy == 'last_name' ? 'selected' : '' }}>Last Name</option>
                            <option value="first_name" {{ $sortBy == 'first_name' ? 'selected' : '' }}>First Name</option>
                            <option value="grade" {{ $sortBy == 'grade' ? 'selected' : '' }}>Grade</option>
                            <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Created Date</option>
                            <option value="incidents_count" {{ $sortBy == 'incidents_count' ? 'selected' : '' }}>Incident Count</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <select name="sort_order" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-4 flex justify-end">
                    <button type="submit" 
                            class="glass-effect hover:glow-effect text-white bg-blue-600 hover:bg-blue-700 font-medium py-2 px-6 rounded-lg transition-all duration-200">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Summary -->
    @if($filteredCount > 0)
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">
                    Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} results
                </span>
                <select name="per_page" onchange="this.form.submit()" class="text-sm border border-gray-300 rounded px-2 py-1">
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per page</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per page</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per page</option>
                </select>
            </div>
        </div>
    @endif

    <!-- Students List -->
    <div class="space-y-4">
        @if($students->count() > 0)
            @foreach($students as $student)
                <div class="glass-effect shadow-xl rounded-2xl p-6 hover:shadow-2xl transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <span class="text-white font-bold text-xl code-font">
                                    {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        {{ $student->full_name }}
                                    </h3>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Grade {{ $student->grade }}
                                    </span>
                                    @if(!$student->is_active)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactive
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-4 mt-1 text-sm text-gray-600">
                                    @if($student->email)
                                        <span>{{ $student->email }}</span>
                                    @endif
                                    @if($student->parent_name)
                                        <span>Parent: {{ $student->parent_name }}</span>
                                    @endif
                                    @if($student->parent_email)
                                        <span>{{ $student->parent_email }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-6">
                            <!-- Incident Statistics -->
                            <div class="text-right">
                                <div class="flex items-center space-x-2">
                                    @if($student->incidents->where('status', 'open')->count() > 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                            {{ $student->incidents->where('status', 'open')->count() }} Active
                                        </span>
                                    @endif
                                    @if($student->incidents->where('status', 'escalated')->count() > 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                                            {{ $student->incidents->where('status', 'escalated')->count() }} Escalated
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <div class="w-2 h-2 bg-gray-500 rounded-full mr-2"></div>
                                        {{ $student->incidents->count() }} Total
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    Member since {{ $student->created_at->format('M Y') }}
                                </p>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('students.show', $student) }}" 
                                   class="glass-effect text-blue-600 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('students.edit', $student) }}" 
                                   class="glass-effect text-gray-600 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $students->appends(request()->query())->links() }}
            </div>
        @else
            <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        @if(request('q') || request()->hasAny(['grade', 'has_incidents', 'status', 'date_from', 'date_to', 'incident_type', 'severity']))
                            No students found matching your criteria
                        @else
                            No students found
                        @endif
                    </h3>
                    <p class="text-gray-600 mb-8">
                        @if(request('q') || request()->hasAny(['grade', 'has_incidents', 'status', 'date_from', 'date_to', 'incident_type', 'severity']))
                            Try adjusting your search terms or filters.
                        @else
                            Get started by adding your first student.
                        @endif
                    </p>
                    <a href="{{ route('students.create') }}" 
                       class="glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Student
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 