@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">User Roles & Permissions</h1>
            </div>
            <p class="text-gray-600">Learn about different user roles and their permissions in the Discipline Tracker system.</p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">System Roles Overview</h2>
                
                <div class="grid gap-6">
                    <!-- Administrator -->
                    <div class="border-l-4 border-red-500 pl-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Administrator</h3>
                        <p class="text-gray-600 mb-4">Full system access with complete control over all features and data.</p>
                        
                        <h4 class="font-semibold text-gray-800 mb-2">Permissions:</h4>
                        <ul class="list-disc list-inside text-gray-600 space-y-1 mb-4">
                            <li>View all students, incidents, and positive reports</li>
                            <li>Create, edit, and delete any records</li>
                            <li>Export data in all formats (Excel, PDF, CSV)</li>
                            <li>Manage user accounts and roles</li>
                            <li>Access system settings and configuration</li>
                            <li>View audit logs and system reports</li>
                        </ul>
                    </div>

                    <!-- Teacher -->
                    <div class="border-l-4 border-blue-500 pl-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Teacher</h3>
                        <p class="text-gray-600 mb-4">Can manage students and create reports, with some restrictions on data access.</p>
                        
                        <h4 class="font-semibold text-gray-800 mb-2">Permissions:</h4>
                        <ul class="list-disc list-inside text-gray-600 space-y-1 mb-4">
                            <li>View all students and their information</li>
                            <li>Create incidents for any student</li>
                            <li>Create positive reports for any student</li>
                            <li>View incidents they created or for their students</li>
                            <li>Export data for their department/grade only</li>
                            <li>Cannot escalate incidents to higher authorities</li>
                        </ul>
                    </div>

                    <!-- Counselor -->
                    <div class="border-l-4 border-green-500 pl-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Counselor</h3>
                        <p class="text-gray-600 mb-4">Specialized role for student support and intervention.</p>
                        
                        <h4 class="font-semibold text-gray-800 mb-2">Permissions:</h4>
                        <ul class="list-disc list-inside text-gray-600 space-y-1 mb-4">
                            <li>View all students and their records</li>
                            <li>Create and manage incidents</li>
                            <li>Create positive reports</li>
                            <li>Escalate incidents when necessary</li>
                            <li>Export data for their assigned students</li>
                            <li>Access student counseling notes</li>
                        </ul>
                    </div>

                    <!-- Principal -->
                    <div class="border-l-4 border-purple-500 pl-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Principal</h3>
                        <p class="text-gray-600 mb-4">Administrative oversight with broad access to school-wide data.</p>
                        
                        <h4 class="font-semibold text-gray-800 mb-2">Permissions:</h4>
                        <ul class="list-disc list-inside text-gray-600 space-y-1 mb-4">
                            <li>View all students, incidents, and reports</li>
                            <li>Create and manage all types of records</li>
                            <li>Export comprehensive school-wide data</li>
                            <li>Approve escalated incidents</li>
                            <li>Access administrative reports</li>
                            <li>Manage teacher and counselor accounts</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 p-6 bg-blue-50 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">Important Notes</h3>
                    <ul class="list-disc list-inside text-blue-800 space-y-2">
                        <li>All users can view the help documentation and access their profile settings</li>
                        <li>Export permissions are role-specific to ensure data privacy</li>
                        <li>Incident escalation requires appropriate role permissions</li>
                        <li>System administrators can modify role permissions as needed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 