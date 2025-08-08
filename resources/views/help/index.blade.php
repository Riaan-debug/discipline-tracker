@extends('layouts.app')

@section('title', 'Help & Documentation')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        <svg class="inline-block w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Help & Documentation
                    </h1>
                    <p class="text-lg text-gray-600">
                        Welcome to the Willow Tree Academy Discipline System help center. Find guides, tutorials, and answers to common questions.
                    </p>
                </div>

                <!-- Quick Start Section -->
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">🚀 Quick Start</h2>
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">New to the system?</h3>
                        <p class="text-gray-600 mb-4">
                            Start here to learn the basics and get up and running quickly.
                        </p>
                        <a href="{{ route('help.getting-started') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Get Started Guide
                        </a>
                    </div>
                </div>

                <!-- Main Help Categories -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- User Roles -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 ml-3">User Roles</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Learn about different user roles and their permissions in the system.
                        </p>
                        <a href="{{ route('help.user-roles') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Learn more →
                        </a>
                    </div>

                    <!-- Students Management -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 ml-3">Students</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            How to manage student information, search, and export student data.
                        </p>
                        <a href="{{ route('help.students') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Learn more →
                        </a>
                    </div>

                    <!-- Incidents -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 ml-3">Incidents</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Creating, managing, and tracking disciplinary incidents.
                        </p>
                        <a href="{{ route('help.incidents') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Learn more →
                        </a>
                    </div>

                    <!-- Positive Reports -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 ml-3">Positive Reports</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Recording and tracking positive student behavior and achievements.
                        </p>
                        <a href="{{ route('help.positive-reports') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Learn more →
                        </a>
                    </div>

                    <!-- Exports -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 ml-3">Exports</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            How to export data in various formats (Excel, PDF, CSV).
                        </p>
                        <a href="{{ route('help.exports') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Learn more →
                        </a>
                    </div>

                    <!-- FAQ -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 ml-3">FAQ</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Frequently asked questions and quick answers.
                        </p>
                        <a href="{{ route('help.faq') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            View FAQ →
                        </a>
                    </div>
                </div>

                <!-- Support Section -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Need More Help?</h2>
                    <p class="text-gray-600 mb-4">
                        Can't find what you're looking for? Contact our support team for assistance.
                    </p>
                    <a href="{{ route('help.support') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 