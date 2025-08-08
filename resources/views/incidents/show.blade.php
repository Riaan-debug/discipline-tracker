@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 code-font">Incident Details</h1>
                    <p class="text-gray-600 mt-1">{{ $incident->incidentType->name }} • {{ $incident->student->full_name }}</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('incidents.edit', $incident) }}" 
                   class="glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Incident
                </a>
                <a href="{{ route('incidents.index') }}" 
                   class="glass-effect hover:glow-effect text-gray-700 hover:text-blue-600 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Incidents
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Incident Information -->
        <div class="lg:col-span-2">
            <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
                <div class="px-6 py-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6 code-font">Incident Information</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Student</h4>
                            <a href="{{ route('students.show', $incident->student) }}" 
                               class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
                                {{ $incident->student->full_name }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Grade</h4>
                            <span class="text-sm text-gray-900">{{ $incident->student->grade }}</span>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Incident Type</h4>
                            <span class="text-sm text-gray-900">{{ $incident->incidentType->name }}</span>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Severity</h4>
                            @if($incident->severity === 'minor')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <div class="w-2 h-2 bg-gray-500 rounded-full mr-2"></div>
                                    Minor
                                </span>
                            @elseif($incident->severity === 'moderate')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                    Moderate
                                </span>
                            @elseif($incident->severity === 'major')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                                    Major
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                    Critical
                                </span>
                            @endif
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Status</h4>
                            @if($incident->status === 'open')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 status-badge">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                    Open
                                </span>
                            @elseif($incident->status === 'resolved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 status-badge">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    Resolved
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 status-badge">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                    Escalated
                                </span>
                            @endif
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Reported By</h4>
                            <span class="text-sm text-gray-900">{{ $incident->reportedBy->name ?? 'Unknown' }}</span>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Reported On</h4>
                            <span class="text-sm text-gray-900">{{ $incident->created_at->format('M j, Y g:i A') }}</span>
                        </div>
                        
                        @if($incident->resolved_at)
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Resolved On</h4>
                                <span class="text-sm text-gray-900">{{ $incident->resolved_at->format('M j, Y g:i A') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Description</h4>
                        <p class="text-sm text-gray-700 bg-gray-50 rounded-lg p-4">{{ $incident->description }}</p>
                    </div>

                    @if($incident->teacher_notes)
                        <div class="border-t border-gray-200 pt-6 mb-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Teacher Notes History</h4>
                            <div class="bg-blue-50 rounded-lg p-4">
                                @php
                                    $notes = explode("\n\n--- ", $incident->teacher_notes);
                                @endphp
                                @foreach($notes as $index => $note)
                                    @if($index === 0)
                                        <div class="mb-4">
                                            <p class="text-sm text-blue-700">{{ $note }}</p>
                                        </div>
                                    @else
                                        @php
                                            $parts = explode(" ---\n", $note, 2);
                                            $timestamp = $parts[0] ?? '';
                                            $content = $parts[1] ?? $note;
                                        @endphp
                                        <div class="mb-4 pb-4 border-b border-blue-200 last:border-b-0">
                                            <div class="text-xs text-blue-600 mb-2">{{ $timestamp }}</div>
                                            <p class="text-sm text-blue-700">{{ $content }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Quick Add Notes -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Add Notes</h4>
                        <form action="{{ route('incidents.add-notes', $incident) }}" method="POST">
                            @csrf
                            <textarea name="additional_notes" 
                                      rows="3"
                                      class="w-full border-0 rounded-xl shadow-lg focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 glass-effect p-4"
                                      placeholder="Add additional notes or follow-up information..."></textarea>
                            <div class="mt-3 flex justify-end">
                                <button type="submit" 
                                        class="glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-2 px-4 rounded-lg transition-all duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add Notes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="lg:col-span-1">
            <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
                <div class="px-6 py-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6 code-font">Actions</h3>
                    
                    <div class="space-y-4">
                        @if($incident->status === 'open')
                            @if(auth()->user()->isAdmin() || auth()->user()->isPrincipal())
                                <form action="{{ route('incidents.resolve', $incident) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="w-full glass-effect hover:glow-effect text-green-600 hover:text-green-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Mark as Resolved
                                    </button>
                                </form>
                            @endif
                            
                            @if(auth()->user()->canEscalateIncidents())
                                <form action="{{ route('incidents.escalate', $incident) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="w-full glass-effect hover:glow-effect text-red-600 hover:text-red-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        Escalate Incident
                                    </button>
                                </form>
                            @endif
                        @elseif($incident->status === 'resolved')
                            <div class="text-center py-4">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 status-badge">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    ✓ Resolved
                                </span>
                            </div>
                        @elseif($incident->status === 'escalated')
                            @if(auth()->user()->isAdmin() || auth()->user()->isPrincipal())
                                <form action="{{ route('incidents.resolve', $incident) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="w-full glass-effect hover:glow-effect text-green-600 hover:text-green-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 flex items-center justify-center mb-4">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Mark as Resolved
                                    </button>
                                </form>
                            @endif
                            
                            <div class="text-center py-2">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800 status-badge">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    ⚠ Escalated
                                </span>
                            </div>
                        @endif
                        
                        <a href="{{ route('incidents.edit', $incident) }}" 
                           class="block w-full glass-effect hover:glow-effect text-blue-600 hover:text-blue-700 font-medium py-3 px-6 rounded-xl transition-all duration-200 text-center flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Incident
                        </a>
                        
                        <a href="{{ route('students.show', $incident->student) }}" 
                           class="block w-full glass-effect hover:glow-effect text-gray-700 hover:text-blue-600 font-medium py-3 px-6 rounded-xl transition-all duration-200 text-center flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            View Student
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 