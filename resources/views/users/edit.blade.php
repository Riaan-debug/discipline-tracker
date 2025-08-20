@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
                    <p class="mt-2 text-gray-600">Update user account: {{ $user->name }}</p>
                </div>
                <a href="{{ route('users.index') }}" 
                   class="text-blue-600 hover:text-blue-900 font-medium">
                    ← Back to Users
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name *
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
                           value="{{ old('name', $user->name) }}"
                           class="{{ $nameClasses }}"
                           placeholder="e.g., John Smith"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address *
                    </label>
                    @php
                        $emailClasses = 'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
                        if ($errors->has('email')) {
                            $emailClasses .= ' border-red-300 focus:ring-red-500 focus:border-red-500';
                        } else {
                            $emailClasses .= ' border-gray-300';
                        }
                    @endphp
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}"
                           class="{{ $emailClasses }}"
                           placeholder="e.g., john.smith@school.edu"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password (Optional) -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        New Password
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Leave blank to keep current password">
                    <p class="mt-1 text-sm text-gray-500">Minimum 8 characters. Leave blank to keep current password.</p>
                </div>

                <!-- Password Confirmation -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm New Password
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Repeat the new password">
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Role *
                    </label>
                    @php
                        $roleClasses = 'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
                        if ($errors->has('role')) {
                            $roleClasses .= ' border-red-300 focus:ring-red-500 focus:border-red-500';
                        } else {
                            $roleClasses .= ' border-gray-300';
                        }
                    @endphp
                    <select id="role" 
                            name="role"
                            class="{{ $roleClasses }}"
                            required>
                        <option value="">Select a role</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="principal" {{ old('role', $user->role) == 'principal' ? 'selected' : '' }}>Principal</option>
                        <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="counselor" {{ old('role', $user->role) == 'counselor' ? 'selected' : '' }}>Counselor</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">
                        <strong>Admin:</strong> Full access to all features<br>
                        <strong>Principal:</strong> Can manage incidents, view reports, manage types<br>
                        <strong>Teacher:</strong> Can create incidents and positive reports<br>
                        <strong>Counselor:</strong> Can view and manage student records
                    </p>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div class="mb-6">
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                        Department *
                    </label>
                    @php
                        $departmentClasses = 'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
                        if ($errors->has('department')) {
                            $departmentClasses .= ' border-red-300 focus:ring-red-500 focus:border-red-500';
                        } else {
                            $departmentClasses .= ' border-gray-300';
                        }
                    @endphp
                    <input type="text" 
                           id="department" 
                           name="department" 
                           value="{{ old('department', $user->department) }}"
                           class="{{ $departmentClasses }}"
                           placeholder="e.g., Mathematics, Administration, Guidance"
                           required>
                    @error('department')
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
                               {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Active (user can log in and access the system)
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('users.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection





