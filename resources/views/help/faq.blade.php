@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

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
                        <h1 class="text-3xl font-bold text-gray-900">Frequently Asked Questions</h1>
                    </div>
                    <p class="text-lg text-gray-600">
                        Find quick answers to common questions about the Willow Tree Academy Discipline System.
                    </p>
                </div>

                <!-- FAQ Categories -->
                <div class="space-y-8">
                    <!-- Authentication & Access -->
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Authentication & Access
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">How do I log in to the system?</h3>
                                <p class="text-gray-600">Use the email and password provided by your administrator. If you haven't received credentials, contact your system administrator.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">I forgot my password. What should I do?</h3>
                                <p class="text-gray-600">Click "Forgot password?" on the login page. You'll receive an email with a link to reset your password. If you don't receive the email, check your spam folder or contact your administrator.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Why can't I access certain features?</h3>
                                <p class="text-gray-600">Your access is based on your user role. Teachers can view students and create reports, but only counselors and principals can escalate incidents. Contact your administrator if you need different permissions.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Students -->
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Students
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">How do I search for a specific student?</h3>
                                <p class="text-gray-600">Use the search bar on the Students page. You can search by name, student ID, or email. You can also use filters to narrow down results by grade, status, or other criteria.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Can I add new students to the system?</h3>
                                <p class="text-gray-600">Only administrators can add new students. If you need to add a student, contact your administrator or use the "Create New Student" button if you have the appropriate permissions.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">How do I export student data?</h3>
                                <p class="text-gray-600">On the Students page, use the filters to select the data you want, then click the "Export" dropdown and choose your preferred format (Excel, PDF, or CSV).</p>
                            </div>
                        </div>
                    </div>

                    <!-- Incidents -->
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            Incidents
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">How do I create a new incident report?</h3>
                                <p class="text-gray-600">Go to the Incidents page and click "Create New Incident." Fill out all required fields including student, incident type, description, and severity level. Click "Create Incident" to save.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">What's the difference between escalating and resolving an incident?</h3>
                                <p class="text-gray-600">Escalating moves an incident to a higher authority (like a principal) for review. Resolving marks an incident as completed with a final outcome. Only counselors and principals can escalate, and only principals and administrators can resolve.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Can I edit an incident after it's been created?</h3>
                                <p class="text-gray-600">Yes, you can edit incidents you've created as long as they haven't been resolved. Click on the incident and use the "Edit" button to make changes.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Positive Reports -->
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Positive Reports
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">How do I create a positive report?</h3>
                                <p class="text-gray-600">Go to the Positive Reports page and click "Create New Report." Select the student, choose the report type, and provide details about the positive behavior or achievement.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">What types of positive reports can I create?</h3>
                                <p class="text-gray-600">You can create reports for academic achievement, good behavior, leadership, community service, sports achievements, and other positive contributions. The specific types available depend on your school's configuration.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data & Exports -->
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Data & Exports
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">What export formats are available?</h3>
                                <p class="text-gray-600">You can export data in Excel (.xlsx), PDF, and CSV formats. Excel is best for detailed analysis, PDF for reports, and CSV for importing into other systems.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Can I export filtered data?</h3>
                                <p class="text-gray-600">Yes! Apply any filters you want (date range, student grade, incident type, etc.) and then export. The export will only include the filtered data.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">How do I get a report for a specific date range?</h3>
                                <p class="text-gray-600">Use the date filters on any list page. You can select a specific date range, and then export the filtered data to get your report.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Technical Issues -->
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Technical Issues
                        </h2>
                        
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">The page is loading slowly. What should I do?</h3>
                                <p class="text-gray-600">Try refreshing the page. If the problem persists, check your internet connection or try logging out and back in. If issues continue, contact your administrator.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">I'm getting an error message. What does it mean?</h3>
                                <p class="text-gray-600">Error messages usually indicate a problem with your input or permissions. Read the message carefully and try again. If you continue to get errors, contact your administrator with the exact error message.</p>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Can I use the system on my mobile device?</h3>
                                <p class="text-gray-600">Yes! The system is designed to work on all devices including phones and tablets. The interface will automatically adjust to your screen size.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Still Need Help -->
                <div class="mt-12 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Still Need Help?</h2>
                    <p class="text-gray-600 mb-4">
                        Can't find the answer you're looking for? We're here to help!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('help.getting-started') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Getting Started Guide
                        </a>
                        <a href="{{ route('help.support') }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Contact Support
                        </a>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between items-center pt-8 border-t border-gray-200">
                    <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        ← Back to Help Center
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 