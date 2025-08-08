@extends('layouts.app')

@section('title', 'Contact Support')

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
                        <h1 class="text-3xl font-bold text-gray-900">Contact Support</h1>
                    </div>
                    <p class="text-lg text-gray-600">
                        Need help with the Willow Tree Academy Discipline System? Here's how to get the support you need.
                    </p>
                </div>

                <!-- Support Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Self-Help -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900 ml-3">Self-Help Resources</h2>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Try these resources first - they often have the answers you need!
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li>• <a href="{{ route('help.faq') }}" class="text-blue-600 hover:text-blue-800">Frequently Asked Questions</a></li>
                            <li>• <a href="{{ route('help.getting-started') }}" class="text-blue-600 hover:text-blue-800">Getting Started Guide</a></li>
                            <li>• <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800">Help Documentation</a></li>
                        </ul>
                    </div>

                    <!-- Contact Administrator -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900 ml-3">Contact Administrator</h2>
                        </div>
                        <p class="text-gray-600 mb-4">
                            For technical issues, account problems, or urgent matters.
                        </p>
                        <div class="space-y-2 text-gray-600">
                            <p><strong>Email:</strong> admin@willowtreeacademy.edu</p>
                            <p><strong>Phone:</strong> (555) 123-4567</p>
                            <p><strong>Office Hours:</strong> Mon-Fri, 8:00 AM - 4:00 PM</p>
                        </div>
                    </div>
                </div>

                <!-- Common Issues -->
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Common Issues & Solutions</h2>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">🔐 Login Problems</h3>
                            <p class="text-gray-600 mb-3">Having trouble logging in?</p>
                            <ul class="space-y-1 text-gray-600 ml-4">
                                <li>• Check that your email and password are correct</li>
                                <li>• Make sure Caps Lock is off</li>
                                <li>• Try the "Forgot Password" feature</li>
                                <li>• Clear your browser cache and cookies</li>
                                <li>• Try a different browser</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">📱 Mobile Access Issues</h3>
                            <p class="text-gray-600 mb-3">Problems using the system on mobile?</p>
                            <ul class="space-y-1 text-gray-600 ml-4">
                                <li>• Make sure you're using a modern browser</li>
                                <li>• Try rotating your device to landscape mode</li>
                                <li>• Check your internet connection</li>
                                <li>• Try refreshing the page</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">📊 Export Problems</h3>
                            <p class="text-gray-600 mb-3">Can't export your data?</p>
                            <ul class="space-y-1 text-gray-600 ml-4">
                                <li>• Make sure you have the necessary permissions</li>
                                <li>• Try a different export format</li>
                                <li>• Check that your browser allows downloads</li>
                                <li>• Try using fewer filters if the export is large</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">⚡ Performance Issues</h3>
                            <p class="text-gray-600 mb-3">System running slowly?</p>
                            <ul class="space-y-1 text-gray-600 ml-4">
                                <li>• Close other browser tabs and applications</li>
                                <li>• Try refreshing the page</li>
                                <li>• Use fewer filters when searching</li>
                                <li>• Check your internet connection speed</li>
                                <li>• Try accessing during off-peak hours</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Before Contacting Support -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Before Contacting Support</h2>
                    <p class="text-gray-600 mb-4">
                        To help us assist you more quickly, please gather the following information:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">System Information:</h3>
                            <ul class="space-y-1 text-gray-600 text-sm">
                                <li>• Your user role and department</li>
                                <li>• Browser type and version</li>
                                <li>• Device type (desktop, tablet, phone)</li>
                                <li>• Operating system</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">Issue Details:</h3>
                            <ul class="space-y-1 text-gray-600 text-sm">
                                <li>• Exact error message (if any)</li>
                                <li>• Steps to reproduce the problem</li>
                                <li>• What you were trying to do</li>
                                <li>• When the issue started</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">🚨 Emergency Support</h2>
                    <p class="text-gray-600 mb-4">
                        For critical system issues that prevent you from performing essential functions:
                    </p>
                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">System Administrator</p>
                            <p class="text-gray-600">Available 24/7 for critical issues</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-900">(555) 999-8888</p>
                            <p class="text-sm text-gray-600">Emergency Hotline</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between items-center pt-8 border-t border-gray-200">
                    <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        ← Back to Help Center
                    </a>
                    <a href="{{ route('help.faq') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                        View FAQ
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