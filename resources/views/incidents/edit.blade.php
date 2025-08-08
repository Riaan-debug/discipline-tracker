@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Edit Incident</h1>
            <a href="{{ route('incidents.show', $incident) }}" 
               class="text-gray-600 hover:text-gray-900">
                ← Back to Incident
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow sm:rounded-lg">
        <form action="{{ route('incidents.update', $incident) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Student Selection -->
                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700">Student</label>
                    <select name="student_id" 
                            id="student_id" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('student_id') border-red-300 @enderror"
                            required>
                        <option value="">Select a student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $incident->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->full_name }} (Grade {{ $student->grade }})
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Incident Type -->
                <div>
                    <label for="incident_type_id" class="block text-sm font-medium text-gray-700">Incident Type</label>
                    <select name="incident_type_id" 
                            id="incident_type_id" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('incident_type_id') border-red-300 @enderror"
                            required>
                        <option value="">Select incident type</option>
                        @foreach($incidentTypes as $type)
                            <option value="{{ $type->id }}" {{ old('incident_type_id', $incident->incident_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('incident_type_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Severity -->
                <div>
                    <label for="severity" class="block text-sm font-medium text-gray-700">Severity Level</label>
                    <select name="severity" 
                            id="severity" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('severity') border-red-300 @enderror"
                            required>
                        <option value="">Select severity</option>
                        <option value="minor" {{ old('severity', $incident->severity) == 'minor' ? 'selected' : '' }}>Minor</option>
                        <option value="moderate" {{ old('severity', $incident->severity) == 'moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="major" {{ old('severity', $incident->severity) == 'major' ? 'selected' : '' }}>Major</option>
                        <option value="critical" {{ old('severity', $incident->severity) == 'critical' ? 'selected' : '' }}>Critical</option>
                    </select>
                    @error('severity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" 
                            id="status" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('status') border-red-300 @enderror"
                            required>
                        <option value="open" {{ old('status', $incident->status) == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="resolved" {{ old('status', $incident->status) == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="escalated" {{ old('status', $incident->status) == 'escalated' ? 'selected' : '' }}>Escalated</option>
                    </select>
                    @error('status')
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
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('description') border-red-300 @enderror"
                          placeholder="Provide a detailed description of the incident..."
                          required>{{ old('description', $incident->description) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Minimum 10 characters required.</p>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teacher Notes -->
            <div class="mt-6">
                <label for="teacher_notes" class="block text-sm font-medium text-gray-700">Teacher Notes (Optional)</label>
                <textarea name="teacher_notes" 
                          id="teacher_notes" 
                          rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('teacher_notes') border-red-300 @enderror"
                          placeholder="Additional notes, actions taken, or follow-up required...">{{ old('teacher_notes', $incident->teacher_notes) }}</textarea>
                @error('teacher_notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex items-center justify-end space-x-3">
                <a href="{{ route('incidents.show', $incident) }}" 
                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Update Incident
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 