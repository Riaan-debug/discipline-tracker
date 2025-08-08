@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 code-font">🌟 Add Positive Report</h1>
                    <p class="mt-2 text-gray-600">Celebrate student achievements and good behavior</p>
                </div>
                <a href="{{ route('positive-reports.index') }}" 
                   class="glass-effect hover:glow-effect text-gray-700 hover:text-green-600 font-medium py-3 px-6 rounded-xl transition-all duration-200">
                    ← Back to Reports
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="glass-effect shadow-xl rounded-2xl overflow-hidden">
            <form action="{{ route('positive-reports.store') }}" method="POST" class="p-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Student Selection -->
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700">Student</label>
                        <select name="student_id" 
                                id="student_id" 
                                class="mt-1 block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm bg-white hover:border-gray-300 transition-colors duration-200 @error('student_id') border-red-300 @enderror"
                                required>
                            <option value="">Select a student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" 
                                        {{ old('student_id', $selectedStudentId ?? '') == $student->id ? 'selected' : '' }}>
                                    {{ $student->full_name }} (Grade {{ $student->grade }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Positive Report Type -->
                    <div>
                        <label for="positive_report_type_id" class="block text-sm font-medium text-gray-700">Achievement Type</label>
                        <select name="positive_report_type_id" 
                                id="positive_report_type_id" 
                                class="mt-1 block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm bg-white hover:border-gray-300 transition-colors duration-200 @error('positive_report_type_id') border-red-300 @enderror"
                                required>
                            <option value="">Select achievement type</option>
                            @foreach($positiveReportTypes as $type)
                                <option value="{{ $type->id }}" {{ old('positive_report_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->icon }} {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('positive_report_type_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" 
                              id="description" 
                              rows="4"
                              class="mt-1 block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm bg-white hover:border-gray-300 transition-colors duration-200 @error('description') border-red-300 @enderror"
                              placeholder="Describe the student's achievement or positive behavior in detail..."
                              required>{{ old('description') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Minimum 10 characters required.</p>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teacher Notes -->
                <div class="mt-6">
                    <label for="teacher_notes" class="block text-sm font-medium text-gray-700">Additional Notes (Optional)</label>
                    <textarea name="teacher_notes" 
                              id="teacher_notes" 
                              rows="3"
                              class="mt-1 block w-full border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm bg-white hover:border-gray-300 transition-colors duration-200 @error('teacher_notes') border-red-300 @enderror"
                              placeholder="Additional context, follow-up actions, or recognition details...">{{ old('teacher_notes') }}</textarea>
                    @error('teacher_notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex items-center justify-end space-x-3">
                    <a href="{{ route('positive-reports.index') }}" 
                       class="glass-effect hover:glow-effect text-gray-700 hover:text-green-600 font-medium py-3 px-6 rounded-xl transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                        Create Positive Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 