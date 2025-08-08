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
                <h1 class="text-3xl font-bold text-gray-900">Data Export Guide</h1>
            </div>
            <p class="text-gray-600">Learn how to export data in various formats (Excel, PDF, CSV) for reporting and analysis.</p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="prose max-w-none">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Exporting Data</h2>
                
                <div class="grid gap-8">
                    <!-- Export Formats -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Available Export Formats</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                                <div class="bg-white rounded-lg p-4 mb-4 inline-block">
                                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Excel (.xlsx)</h4>
                                <p class="text-sm text-gray-600 mb-4">Professional spreadsheet format with formatting, formulas, and multiple sheets.</p>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li>• Formatted tables and charts</li>
                                    <li>• Multiple worksheets</li>
                                    <li>• Formulas and calculations</li>
                                    <li>• Professional appearance</li>
                                </ul>
                            </div>
                            
                            <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center">
                                <div class="bg-white rounded-lg p-4 mb-4 inline-block">
                                    <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">PDF</h4>
                                <p class="text-sm text-gray-600 mb-4">Printable document format perfect for official reports and presentations.</p>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li>• Professional formatting</li>
                                    <li>• Print-ready documents</li>
                                    <li>• Consistent appearance</li>
                                    <li>• Official documentation</li>
                                </ul>
                            </div>
                            
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                                <div class="bg-white rounded-lg p-4 mb-4 inline-block">
                                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">CSV</h4>
                                <p class="text-sm text-gray-600 mb-4">Simple data format for importing into other systems and databases.</p>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li>• Simple text format</li>
                                    <li>• Easy data import</li>
                                    <li>• Database compatible</li>
                                    <li>• Lightweight files</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- How to Export -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">How to Export Data</h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-4">
                            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                                <li><strong>Navigate to the desired section:</strong> Go to Students, Incidents, or Positive Reports</li>
                                <li><strong>Apply filters (optional):</strong> Use search and filter options to narrow down the data</li>
                                <li><strong>Click the Export button:</strong> Look for the export options in the top-right area</li>
                                <li><strong>Choose your format:</strong> Select Excel, PDF, or CSV from the dropdown</li>
                                <li><strong>Download the file:</strong> The file will automatically download to your device</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Export Options by Section -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Export Options by Section</h3>
                        <div class="grid gap-4">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-800 mb-2">Students Export</h4>
                                <p class="text-gray-700 mb-2">Export student information including:</p>
                                <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                    <li>Basic student information (name, ID, grade, department)</li>
                                    <li>Contact details and enrollment status</li>
                                    <li>Incident history summary</li>
                                    <li>Positive report summary</li>
                                </ul>
                            </div>
                            
                            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-800 mb-2">Incidents Export</h4>
                                <p class="text-gray-700 mb-2">Export incident reports including:</p>
                                <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                    <li>Incident details and descriptions</li>
                                    <li>Student information and involvement</li>
                                    <li>Date, time, and location data</li>
                                    <li>Resolution status and follow-up actions</li>
                                </ul>
                            </div>
                            
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                                <h4 class="font-semibold text-gray-800 mb-2">Positive Reports Export</h4>
                                <p class="text-gray-700 mb-2">Export positive behavior records including:</p>
                                <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                    <li>Positive behavior descriptions</li>
                                    <li>Student recognition details</li>
                                    <li>Achievement dates and types</li>
                                    <li>Recognition programs and awards</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Role-Based Export Permissions -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Role-Based Export Permissions</h3>
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 mb-4">
                            <p class="text-gray-700 mb-3">Export permissions vary by user role:</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Administrators & Principals</h4>
                                    <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                        <li>Full access to all export formats</li>
                                        <li>Complete school-wide data</li>
                                        <li>All sections available</li>
                                        <li>No restrictions on data scope</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Teachers & Counselors</h4>
                                    <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                        <li>Limited to their department/grade</li>
                                        <li>All export formats available</li>
                                        <li>Filtered data based on role</li>
                                        <li>Student privacy protection</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Best Practices -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Export Best Practices</h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Use filters:</strong> Narrow down data before exporting to get more relevant results</li>
                                <li><strong>Choose the right format:</strong> Excel for analysis, PDF for presentations, CSV for data import</li>
                                <li><strong>Check file size:</strong> Large exports may take time to generate</li>
                                <li><strong>Verify data:</strong> Review exported files to ensure accuracy</li>
                                <li><strong>Secure storage:</strong> Store exported files securely, especially sensitive student data</li>
                                <li><strong>Regular backups:</strong> Export important data regularly for backup purposes</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Troubleshooting -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Troubleshooting</h3>
                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                            <div class="space-y-3">
                                <div>
                                    <h4 class="font-semibold text-gray-800">Export not working?</h4>
                                    <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                        <li>Check your internet connection</li>
                                        <li>Ensure you have permission to export data</li>
                                        <li>Try a different export format</li>
                                        <li>Clear your browser cache and try again</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">File not downloading?</h4>
                                    <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm">
                                        <li>Check your browser's download settings</li>
                                        <li>Look in your Downloads folder</li>
                                        <li>Try using a different browser</li>
                                        <li>Check if your antivirus is blocking the download</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 