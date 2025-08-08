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
                <h1 class="text-3xl font-bold text-gray-900">Positive Reports</h1>
            </div>
            <p class="text-gray-600">Learn how to record and track positive student behavior and achievements.</p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Managing Positive Reports</h2>
                
                <div class="grid gap-8">
                    <!-- Creating Positive Reports -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Creating Positive Reports</h3>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-4">
                            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                                <li>Navigate to the <strong>Positive Reports</strong> section from the main menu</li>
                                <li>Click the <strong>"Create Positive Report"</strong> button</li>
                                <li>Fill in the report details:
                                    <ul class="list-disc list-inside ml-6 mt-2 space-y-1">
                                        <li>Select the student being recognized</li>
                                        <li>Choose the positive behavior type</li>
                                        <li>Enter a detailed description of the achievement</li>
                                        <li>Select the date when it occurred</li>
                                        <li>Add any supporting details or context</li>
                                        <li>Include any rewards or recognition given</li>
                                    </ul>
                                </li>
                                <li>Click <strong>"Save Report"</strong> to record the positive behavior</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Positive Behavior Types -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Types of Positive Behaviors</h3>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Recognize various types of positive student behavior:</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Academic Achievement</h4>
                                    <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                        <li>Outstanding academic performance</li>
                                        <li>Significant improvement in grades</li>
                                        <li>Exceptional project or assignment work</li>
                                        <li>Academic leadership or mentoring</li>
                                        <li>Participation in academic competitions</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Character & Citizenship</h4>
                                    <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                        <li>Helping other students</li>
                                        <li>Demonstrating leadership qualities</li>
                                        <li>Showing respect and kindness</li>
                                        <li>Community service or volunteer work</li>
                                        <li>Positive role model behavior</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Viewing and Managing -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Viewing and Managing Reports</h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Access and manage positive reports:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                <li><strong>Report List:</strong> View all positive reports with filtering options</li>
                                <li><strong>Search:</strong> Find reports by student name, date, or behavior type</li>
                                <li><strong>Details:</strong> Click on any report to view full details</li>
                                <li><strong>Edit:</strong> Modify report information if needed</li>
                                <li><strong>Student History:</strong> View all positive reports for a specific student</li>
                                <li><strong>Recognition Tracking:</strong> Monitor patterns of positive behavior</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Recognition Programs -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Recognition Programs</h3>
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Use positive reports to support recognition programs:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Student of the Month:</strong> Identify candidates based on positive reports</li>
                                <li><strong>Achievement Awards:</strong> Track progress toward recognition milestones</li>
                                <li><strong>Parent Communication:</strong> Share positive news with families</li>
                                <li><strong>Classroom Incentives:</strong> Use reports to motivate class-wide behavior</li>
                                <li><strong>Graduation Recognition:</strong> Compile achievements for graduation ceremonies</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Reporting and Analytics -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Reporting and Analytics</h3>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Generate reports and analyze positive behavior patterns:</p>
                            <ul class="list-disc list-inside text-gray-700 space-y-1">
                                <li><strong>Individual Reports:</strong> Track positive behavior for specific students</li>
                                <li><strong>Class Reports:</strong> Analyze positive patterns by grade or department</li>
                                <li><strong>Recognition Trends:</strong> Identify most common positive behaviors</li>
                                <li><strong>Export Options:</strong> Download reports in Excel, PDF, or CSV format</li>
                                <li><strong>Monthly Summaries:</strong> Automated positive behavior reports</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Best Practices -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Best Practices</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Be Specific:</strong> Include detailed descriptions of the positive behavior</li>
                                <li><strong>Recognize Effort:</strong> Acknowledge both achievement and effort</li>
                                <li><strong>Timely Recognition:</strong> Report positive behavior soon after it occurs</li>
                                <li><strong>Balanced Approach:</strong> Ensure all students have opportunities for recognition</li>
                                <li><strong>Share with Parents:</strong> Use reports to communicate positive news to families</li>
                                <li><strong>Follow Up:</strong> Continue to recognize sustained positive behavior</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 