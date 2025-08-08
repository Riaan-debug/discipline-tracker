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
                <h1 class="text-3xl font-bold text-gray-900">Incident Management</h1>
            </div>
            <p class="text-gray-600">Learn how to create, manage, and track disciplinary incidents.</p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Managing Incidents</h2>
                
                <div class="grid gap-8">
                    <!-- Creating Incidents -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Creating New Incidents</h3>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-4">
                            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                                <li>Navigate to the <strong>Incidents</strong> section from the main menu</li>
                                <li>Click the <strong>"Report New Incident"</strong> button</li>
                                <li>Fill in the incident details:
                                    <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                        <li>Select the student(s) involved</li>
                                        <li>Choose the incident type from the dropdown</li>
                                        <li>Enter a detailed description of what happened</li>
                                        <li>Select the date and time of the incident</li>
                                        <li>Choose the location where it occurred</li>
                                        <li>Add any witnesses or additional notes</li>
                                    </ul>
                                </li>
                                <li>Click <strong>"Save Incident"</strong> to record the incident</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Incident Types -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Incident Types</h3>
                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">The system includes various incident categories:</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Minor Incidents</h4>
                                    <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                        <li>Tardiness</li>
                                        <li>Dress code violations</li>
                                        <li>Minor classroom disruptions</li>
                                        <li>Incomplete homework</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Major Incidents</h4>
                                    <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                        <li>Fighting or physical altercations</li>
                                        <li>Bullying or harassment</li>
                                        <li>Vandalism or property damage</li>
                                        <li>Substance use or possession</li>
                                        <li>Weapon possession</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Viewing and Managing -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Viewing and Managing Incidents</h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Access and manage existing incidents:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                <li><strong>Incident List:</strong> View all incidents with filtering options</li>
                                <li><strong>Search:</strong> Find incidents by student name, date, or type</li>
                                <li><strong>Details:</strong> Click on any incident to view full details</li>
                                <li><strong>Edit:</strong> Modify incident information if needed</li>
                                <li><strong>Status Updates:</strong> Track resolution progress</li>
                                <li><strong>Follow-up Actions:</strong> Record disciplinary measures taken</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Escalation Process -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Incident Escalation</h3>
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">For serious incidents that require higher-level intervention:</p>
                            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                                <li><strong>Assessment:</strong> Evaluate the severity of the incident</li>
                                <li><strong>Escalation Request:</strong> Submit for administrative review</li>
                                <li><strong>Administrative Review:</strong> Principal or counselor review</li>
                                <li><strong>Action Plan:</strong> Determine appropriate disciplinary measures</li>
                                <li><strong>Follow-up:</strong> Monitor student progress and compliance</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Reporting and Analytics -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Reporting and Analytics</h3>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Generate reports and analyze incident patterns:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                <li><strong>Individual Reports:</strong> Track incidents for specific students</li>
                                <li><strong>Class Reports:</strong> Analyze patterns by grade or department</li>
                                <li><strong>Trend Analysis:</strong> Identify recurring issues</li>
                                <li><strong>Export Options:</strong> Download reports in Excel, PDF, or CSV format</li>
                                <li><strong>Monthly Summaries:</strong> Automated reports sent to administrators</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Best Practices -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Best Practices</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Document Immediately:</strong> Record incidents as soon as possible after they occur</li>
                                <li><strong>Be Specific:</strong> Include detailed descriptions and witness statements</li>
                                <li><strong>Follow Procedures:</strong> Adhere to school disciplinary policies</li>
                                <li><strong>Maintain Confidentiality:</strong> Protect student privacy and sensitive information</li>
                                <li><strong>Regular Review:</strong> Periodically review and update incident records</li>
                                <li><strong>Communication:</strong> Keep parents and administrators informed as appropriate</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 