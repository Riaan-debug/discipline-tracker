@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 code-font">🌟 Positive Report Details</h1>
                    <p class="mt-2 text-gray-600">Celebrating student achievement</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('positive-reports.edit', $positiveReport) }}" 
                       class="glass-effect hover:glow-effect text-green-700 hover:text-green-800 font-medium py-3 px-6 rounded-xl transition-all duration-200">
                        Edit Report
                    </a>
                    <a href="{{ route('positive-reports.index') }}" 
                       class="glass-effect hover:glow-effect text-gray-700 hover:text-green-600 font-medium py-3 px-6 rounded-xl transition-all duration-200">
                        ← Back to Reports
                    </a>
                </div>
            </div>
        </div>

        <!-- Report Details -->
        <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
            <div class="p-8">
                <!-- Student Info -->
                <div class="flex items-center space-x-4 mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center text-white font-semibold text-2xl">
                        {{ substr($positiveReport->student->first_name, 0, 1) }}{{ substr($positiveReport->student->last_name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $positiveReport->student->full_name }}</h2>
                        <p class="text-gray-600">Grade {{ $positiveReport->student->grade }}</p>
                    </div>
                </div>

                <!-- Achievement Type -->
                <div class="mb-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <span class="text-4xl">{{ $positiveReport->positiveReportType->icon }}</span>
                        <h3 class="text-xl font-semibold text-green-700">{{ $positiveReport->positiveReportType->name }}</h3>
                    </div>
                    @if($positiveReport->positiveReportType->description)
                        <p class="text-gray-600">{{ $positiveReport->positiveReportType->description }}</p>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Description</h4>
                    <div class="bg-white rounded-lg p-4 border-l-4 border-green-500">
                        <p class="text-gray-700">{{ $positiveReport->description }}</p>
                    </div>
                </div>

                <!-- Teacher Notes -->
                @if($positiveReport->teacher_notes)
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-3">Additional Notes</h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700">{{ $positiveReport->teacher_notes }}</p>
                        </div>
                    </div>
                @endif

                <!-- Report Metadata -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">Reported by:</span> 
                            {{ $positiveReport->reportedBy->name ?? 'School Staff' }}
                        </div>
                        <div>
                            <span class="font-medium">Date:</span> 
                            {{ $positiveReport->created_at->format('F j, Y \a\t g:i A') }}
                        </div>
                        <div>
                            <span class="font-medium">Status:</span> 
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                        </div>
                        <div>
                            <span class="font-medium">Last updated:</span> 
                            {{ $positiveReport->updated_at->format('F j, Y \a\t g:i A') }}
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('students.show', $positiveReport->student) }}" 
                           class="glass-effect hover:glow-effect text-blue-700 hover:text-blue-800 font-medium py-2 px-4 rounded-lg transition-all duration-200">
                            View Student Profile
                        </a>
                        <a href="{{ route('positive-reports.create', ['student_id' => $positiveReport->student->id]) }}" 
                           class="glass-effect hover:glow-effect text-green-700 hover:text-green-800 font-medium py-2 px-4 rounded-lg transition-all duration-200">
                            Add Another Report
                        </a>
                    </div>
                    
                    <form action="{{ route('positive-reports.destroy', $positiveReport) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="glass-effect hover:glow-effect text-red-700 hover:text-red-800 font-medium py-2 px-4 rounded-lg transition-all duration-200"
                                onclick="return confirm('Are you sure you want to archive this positive report?')">
                            Archive Report
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 