@extends('layouts.app')

@section('title', 'Getting Started Guide')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-gray-900">Getting Started Guide</h1>
                    </div>
                    <p class="text-lg text-gray-600">
                        Welcome to the Willow Tree Academy Discipline System! This guide will help you get up and running quickly.
                    </p>
                </div>

                <!-- Table of Contents -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">📋 What You'll Learn</h2>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center">
                            <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">1</span>
                            <a href="#first-login" class="hover:text-blue-600">First Login & Account Setup</a>
                        </li>
                        <li class="flex items-center">
                            <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">2</span>
                            <a href="#user-roles" class="hover:text-blue-600">Understanding User Roles</a>
                        </li>
                        <li class="flex items-center">
                            <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">3</span>
                            <a href="#basic-navigation" class="hover:text-blue-600">Basic Navigation</a>
                        </li>
                        <li class="flex items-center">
                            <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">4</span>
                            <a href="#first-steps" class="hover:text-blue-600">Your First Steps</a>
                        </li>
                        <li class="flex items-center">
                            <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">5</span>
                            <a href="#next-steps" class="hover:text-blue-600">Next Steps & Resources</a>
                        </li>
                    </ul>
                </div>

                <!-- Section 1: First Login -->
                <div id="first-login" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">1</span>
                        First Login & Account Setup
                    </h2>
                    
                    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">🔐 Logging In</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-medium mr-3 mt-0.5">✓</div>
                                <div>
                                    <p class="font-medium text-gray-900">Use your provided credentials</p>
                                    <p class="text-gray-600">Your administrator will provide you with your email and password.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-medium mr-3 mt-0.5">✓</div>
                                <div>
                                    <p class="font-medium text-gray-900">Complete email verification</p>
                                    <p class="text-gray-600">Check your email for a verification link and click it to activate your account.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-medium mr-3 mt-0.5">✓</div>
                                <div>
                                    <p class="font-medium text-gray-900">Set a new password (optional)</p>
                                    <p class="text-gray-600">You can change your password anytime from your profile page.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">⚠️ Important Security Notes</h3>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Never share your login credentials with others
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Always log out when you're done using the system
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Contact your administrator if you forget your password
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Section 2: User Roles -->
                <div id="user-roles" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">2</span>
                        Understanding User Roles
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 ml-3">Administrator</h3>
                            </div>
                            <ul class="space-y-2 text-gray-600">
                                <li>• Full system access</li>
                                <li>• Manage all users and data</li>
                                <li>• View audit logs</li>
                                <li>• System configuration</li>
                            </ul>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 ml-3">Teacher</h3>
                            </div>
                            <ul class="space-y-2 text-gray-600">
                                <li>• View all students</li>
                                <li>• Create incidents & reports</li>
                                <li>• Export department data</li>
                                <li>• Cannot escalate incidents</li>
                            </ul>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 ml-3">Counselor</h3>
                            </div>
                            <ul class="space-y-2 text-gray-600">
                                <li>• View all students</li>
                                <li>• Create incidents & reports</li>
                                <li>• Escalate incidents</li>
                                <li>• Access to all data</li>
                            </ul>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 ml-3">Principal</h3>
                            </div>
                            <ul class="space-y-2 text-gray-600">
                                <li>• Full data access</li>
                                <li>• Resolve incidents</li>
                                <li>• Escalate incidents</li>
                                <li>• View all reports</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('help.user-roles') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Learn more about user roles and permissions →
                        </a>
                    </div>
                </div>

                <!-- Section 3: Basic Navigation -->
                <div id="basic-navigation" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">3</span>
                        Basic Navigation
                    </h2>
                    
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">🏠 Dashboard</h3>
                                <p class="text-gray-600 mb-4">Your central hub showing:</p>
                                <ul class="space-y-2 text-gray-600">
                                    <li>• Recent incidents and reports</li>
                                    <li>• Quick statistics</li>
                                    <li>• System status</li>
                                    <li>• Quick access to main features</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">🧭 Main Navigation</h3>
                                <ul class="space-y-2 text-gray-600">
                                    <li><strong>Students:</strong> Manage student information</li>
                                    <li><strong>Incidents:</strong> Track disciplinary issues</li>
                                    <li><strong>Positive Reports:</strong> Record good behavior</li>
                                    <li><strong>Help:</strong> Access documentation</li>
                                    <li><strong>Profile:</strong> Manage your account</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: First Steps -->
                <div id="first-steps" class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">4</span>
                        Your First Steps
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">👥 Step 1: Explore Students</h3>
                            <p class="text-gray-600 mb-4">Start by familiarizing yourself with the student management system:</p>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <ol class="space-y-2 text-gray-700">
                                    <li>1. Click "Students" in the navigation</li>
                                    <li>2. Browse the student list</li>
                                    <li>3. Try the search and filter features</li>
                                    <li>4. Click on a student to view details</li>
                                </ol>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">📝 Step 2: Create Your First Report</h3>
                            <p class="text-gray-600 mb-4">Practice creating an incident or positive report:</p>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <ol class="space-y-2 text-gray-700">
                                    <li>1. Go to "Incidents" or "Positive Reports"</li>
                                    <li>2. Click "Create New"</li>
                                    <li>3. Fill out the required information</li>
                                    <li>4. Submit the report</li>
                                </ol>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">📊 Step 3: Export Data</h3>
                            <p class="text-gray-600 mb-4">Learn how to export information:</p>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <ol class="space-y-2 text-gray-700">
                                    <li>1. Go to any list page (Students, Incidents, etc.)</li>
                                    <li>2. Use filters to narrow down data</li>
                                    <li>3. Click the "Export" dropdown</li>
                                    <li>4. Choose your preferred format (Excel, PDF, CSV)</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Next Steps -->
                <div id="next-steps" class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mr-3">5</span>
                        Next Steps & Resources
                    </h2>
                    
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">📚 Continue Learning</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Detailed Guides:</h4>
                                <ul class="space-y-1 text-gray-600">
                                    <li>• <a href="{{ route('help.students') }}" class="text-blue-600 hover:text-blue-800">Students Management</a></li>
                                    <li>• <a href="{{ route('help.incidents') }}" class="text-blue-600 hover:text-blue-800">Incidents Guide</a></li>
                                    <li>• <a href="{{ route('help.positive-reports') }}" class="text-blue-600 hover:text-blue-800">Positive Reports</a></li>
                                    <li>• <a href="{{ route('help.exports') }}" class="text-blue-600 hover:text-blue-800">Export Guide</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 mb-2">Quick Help:</h4>
                                <ul class="space-y-1 text-gray-600">
                                    <li>• <a href="{{ route('help.faq') }}" class="text-blue-600 hover:text-blue-800">Frequently Asked Questions</a></li>
                                    <li>• <a href="{{ route('help.support') }}" class="text-blue-600 hover:text-blue-800">Contact Support</a></li>
                                    <li>• <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800">Help Center</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between items-center pt-8 border-t border-gray-200">
                    <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        ← Back to Help Center
                    </a>
                    <a href="{{ route('help.user-roles') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                        Next: User Roles
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 