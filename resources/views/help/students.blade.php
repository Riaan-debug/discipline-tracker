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
                <h1 class="text-3xl font-bold text-gray-900">Student Management</h1>
            </div>
            <p class="text-gray-600">Learn how to manage student information, search, and export student data.</p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Managing Students</h2>
                
                <div class="grid gap-8">
                    <!-- Adding Students -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Adding New Students</h3>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-4">
                            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                                <li>Navigate to the <strong>Students</strong> section from the main menu</li>
                                <li>Click the <strong>"Add New Student"</strong> button</li>
                                <li>Fill in the required information:
                                    <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                        <li>Student ID (unique identifier)</li>
                                        <li>Full Name</li>
                                        <li>Grade Level</li>
                                        <li>Department</li>
                                        <li>Contact Information (optional)</li>
                                    </ul>
                                </li>
                                <li>Click <strong>"Save Student"</strong> to add the student to the system</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Searching Students -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Searching and Filtering</h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Use the search bar to quickly find students:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                <li><strong>Name Search:</strong> Type any part of the student's name</li>
                                <li><strong>ID Search:</strong> Enter the student ID number</li>
                                <li><strong>Grade Filter:</strong> Filter by specific grade levels</li>
                                <li><strong>Department Filter:</strong> Filter by academic departments</li>
                                <li><strong>Status Filter:</strong> Filter by active/inactive status</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Viewing Student Details -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Viewing Student Information</h3>
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Click on any student to view detailed information:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                <li><strong>Basic Information:</strong> Name, ID, grade, department</li>
                                <li><strong>Incident History:</strong> All reported incidents for the student</li>
                                <li><strong>Positive Reports:</strong> Recognition and achievements</li>
                                <li><strong>Contact Information:</strong> Parent/guardian details</li>
                                <li><strong>Status:</strong> Current enrollment status</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Exporting Data -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Exporting Student Data</h3>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Export student information in various formats:</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-center">
                                    <div class="bg-white rounded-lg p-3 mb-2">
                                        <svg class="w-8 h-8 text-green-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-800">Excel (.xlsx)</h4>
                                    <p class="text-sm text-gray-600">Spreadsheet format with formatting</p>
                                </div>
                                <div class="text-center">
                                    <div class="bg-white rounded-lg p-3 mb-2">
                                        <svg class="w-8 h-8 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-800">PDF</h4>
                                    <p class="text-sm text-gray-600">Printable document format</p>
                                </div>
                                <div class="text-center">
                                    <div class="bg-white rounded-lg p-3 mb-2">
                                        <svg class="w-8 h-8 text-blue-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-800">CSV</h4>
                                    <p class="text-sm text-gray-600">Simple data format</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role-Based Access -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Role-Based Access</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <p class="text-gray-700 mb-3">Access to student data varies by user role:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                <li><strong>Administrators:</strong> Full access to all student data and export capabilities</li>
                                <li><strong>Teachers:</strong> Can view all students but export only their department/grade data</li>
                                <li><strong>Counselors:</strong> Access to assigned students and comprehensive export options</li>
                                <li><strong>Principals:</strong> Full access to school-wide student data</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 