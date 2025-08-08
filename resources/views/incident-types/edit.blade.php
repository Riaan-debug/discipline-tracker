@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Incident Type</h1>
                    <p class="mt-2 text-gray-600">Update incident type: {{ $incidentType->name }}</p>
                </div>
                <a href="{{ route('incident-types.index') }}" 
                   class="text-blue-600 hover:text-blue-900 font-medium">
                    ← Back to Incident Types
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('incident-types.update', $incidentType) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Incident Type Name *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $incidentType->name) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                           placeholder="e.g., Bullying, Fighting, Tardiness"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                              placeholder="Optional description of this incident type">{{ old('description', $incidentType->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Severity Level -->
                <div class="mb-6">
                    <label for="severity" class="block text-sm font-medium text-gray-700 mb-2">
                        Default Severity Level
                    </label>
                    <select id="severity" 
                            name="severity"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('severity') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                        <option value="">Select severity level (optional)</option>
                        <option value="minor" {{ old('severity', $incidentType->severity) == 'minor' ? 'selected' : '' }}>Minor</option>
                        <option value="moderate" {{ old('severity', $incidentType->severity) == 'moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="major" {{ old('severity', $incidentType->severity) == 'major' ? 'selected' : '' }}>Major</option>
                        <option value="critical" {{ old('severity', $incidentType->severity) == 'critical' ? 'selected' : '' }}>Critical</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">This will be the default severity when creating incidents of this type</p>
                    @error('severity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div class="mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="is_active" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', $incidentType->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Active (available for incident reports)
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('incident-types.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Update Incident Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
