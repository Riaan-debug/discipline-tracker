@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Edit Student</h1>
            <a href="{{ route('students.show', $student) }}" 
               class="text-gray-600 hover:text-gray-900">
                ← Back to Student
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow sm:rounded-lg">
        <form action="{{ route('students.update', $student) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" 
                           name="first_name" 
                           id="first_name" 
                           value="{{ old('first_name', $student->first_name) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('first_name') border-red-300 @enderror"
                           required>
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" 
                           name="last_name" 
                           id="last_name" 
                           value="{{ old('last_name', $student->last_name) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('last_name') border-red-300 @enderror"
                           required>
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email (Optional)</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $student->email) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-300 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grade -->
                <div>
                    <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                    <select name="grade" 
                            id="grade" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('grade') border-red-300 @enderror"
                            required>
                        <option value="">Select Grade</option>
                        <option value="RR" {{ old('grade', $student->grade) == 'RR' ? 'selected' : '' }}>Grade RR</option>
                        <option value="R" {{ old('grade', $student->grade) == 'R' ? 'selected' : '' }}>Grade R</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ old('grade', $student->grade) == (string)$i ? 'selected' : '' }}>
                                Grade {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('grade')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Parent Name -->
                <div>
                    <label for="parent_name" class="block text-sm font-medium text-gray-700">Parent/Guardian Name</label>
                    <input type="text" 
                           name="parent_name" 
                           id="parent_name" 
                           value="{{ old('parent_name', $student->parent_name) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('parent_name') border-red-300 @enderror"
                           required>
                    @error('parent_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Parent Email -->
                <div>
                    <label for="parent_email" class="block text-sm font-medium text-gray-700">Parent/Guardian Email</label>
                    <input type="email" 
                           name="parent_email" 
                           id="parent_email" 
                           value="{{ old('parent_email', $student->parent_email) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('parent_email') border-red-300 @enderror"
                           required>
                    @error('parent_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Parent Phone -->
                <div>
                    <label for="parent_phone" class="block text-sm font-medium text-gray-700">Parent/Guardian Phone (Optional)</label>
                    <input type="tel" 
                           name="parent_phone" 
                           id="parent_phone" 
                           value="{{ old('parent_phone', $student->parent_phone) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('parent_phone') border-red-300 @enderror">
                    @error('parent_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div>
                    <label for="is_active" class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               id="is_active" 
                               value="1"
                               {{ old('is_active', $student->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Active Student</span>
                    </label>
                </div>
            </div>

            <!-- Notes -->
            <div class="mt-6">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                <textarea name="notes" 
                          id="notes" 
                          rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('notes') border-red-300 @enderror"
                          placeholder="Any additional notes about the student...">{{ old('notes', $student->notes) }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex items-center justify-end space-x-3">
                <a href="{{ route('students.show', $student) }}" 
                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 