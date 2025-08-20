@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Achievement Type</h1>
                    <p class="mt-2 text-gray-600">Update achievement type: {{ $positiveReportType->name }}</p>
                </div>
                <a href="{{ route('positive-report-types.index') }}" 
                   class="text-blue-600 hover:text-blue-900 font-medium">
                    ← Back to Achievement Types
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('positive-report-types.update', $positiveReportType) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Achievement Type Name *
                    </label>
                    @php
                        $nameClasses = 'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
                        if ($errors->has('name')) {
                            $nameClasses .= ' border-red-300 focus:ring-red-500 focus:border-red-500';
                        } else {
                            $nameClasses .= ' border-gray-300';
                        }
                    @endphp
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $positiveReportType->name) }}"
                           class="{{ $nameClasses }}"
                           placeholder="e.g., Academic Excellence, Leadership, Sports Achievement"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon -->
                <div class="mb-6">
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                        Icon (Emoji)
                    </label>
                    @php
                        $iconClasses = 'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
                        if ($errors->has('icon')) {
                            $iconClasses .= ' border-red-300 focus:ring-red-500 focus:border-red-500';
                        } else {
                            $iconClasses .= ' border-gray-300';
                        }
                    @endphp
                    <input type="text" 
                           id="icon" 
                           name="icon" 
                           value="{{ old('icon', $positiveReportType->icon) }}"
                           class="{{ $iconClasses }}"
                           placeholder="e.g., 🏆, 📚, 👑, ⭐"
                           maxlength="10">
                    <p class="mt-1 text-sm text-gray-500">Optional emoji to represent this achievement type</p>
                    @error('icon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    @php
                        $descriptionClasses = 'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
                        if ($errors->has('description')) {
                            $descriptionClasses .= ' border-red-300 focus:ring-red-500 focus:border-red-500';
                        } else {
                            $descriptionClasses .= ' border-gray-300';
                        }
                    @endphp
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              class="{{ $descriptionClasses }}"
                              placeholder="Optional description of this achievement type">{{ old('description', $positiveReportType->description) }}</textarea>
                    @error('description')
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
                               {{ old('is_active', $positiveReportType->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Active (available for positive reports)
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('positive-report-types.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Update Achievement Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection





