@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Profile Settings</h1>
        <p class="text-gray-600 mt-2">Manage your account information and security</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Profile Information -->
        <div class="glass-effect shadow-xl rounded-2xl p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Profile Information</h2>
            
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 focus:ring-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 focus:ring-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                        Department
                    </label>
                    <input type="text" id="department" name="department" value="{{ old('department', $user->department) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('department') border-red-300 focus:ring-red-500 @enderror"
                           placeholder="e.g., Mathematics, Science, etc.">
                    @error('department')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role (Read-only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Role
                    </label>
                    <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-700">
                        {{ $user->role_display_name }}
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-[1.02]">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div class="glass-effect shadow-xl rounded-2xl p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Change Password</h2>
            
            <form method="POST" action="{{ route('profile.password') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Current Password
                    </label>
                    <input type="password" id="current_password" name="current_password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-300 focus:ring-red-500 @enderror">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        New Password
                    </label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-300 focus:ring-red-500 @enderror"
                           placeholder="Minimum 8 characters">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm New Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 px-4 rounded-xl font-medium hover:from-green-700 hover:to-emerald-700 transition-all duration-200 transform hover:scale-[1.02]">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Account Statistics -->
    <div class="mt-8 glass-effect shadow-xl rounded-2xl p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Account Statistics</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-4 bg-blue-50 rounded-xl">
                <div class="text-2xl font-bold text-blue-600">{{ $user->reportedIncidents()->count() }}</div>
                <div class="text-sm text-gray-600">Incidents Reported</div>
            </div>
            
            <div class="text-center p-4 bg-green-50 rounded-xl">
                <div class="text-2xl font-bold text-green-600">{{ $user->submittedPositiveReports()->count() }}</div>
                <div class="text-sm text-gray-600">Positive Reports</div>
            </div>
            
            <div class="text-center p-4 bg-purple-50 rounded-xl">
                <div class="text-2xl font-bold text-purple-600">{{ $user->created_at->diffForHumans() }}</div>
                <div class="text-sm text-gray-600">Member Since</div>
            </div>
        </div>
    </div>
</div>
@endsection 