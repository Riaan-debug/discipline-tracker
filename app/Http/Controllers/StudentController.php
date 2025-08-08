<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Incident;
use App\Models\IncidentType;
use App\Exports\StudentsExport;
use App\Services\PDFExportService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = auth()->user();
        $query = $request->get('q');
        $gradeFilter = $request->get('grade');
        $incidentFilter = $request->get('has_incidents');
        $statusFilter = $request->get('status');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $incidentTypeFilter = $request->get('incident_type');
        $severityFilter = $request->get('severity');
        $sortBy = $request->get('sort_by', 'last_name');
        $sortOrder = $request->get('sort_order', 'asc');
        $perPage = $request->get('per_page', 25);
        
        $students = Student::with(['incidents' => function ($query) {
            $query->with(['incidentType', 'reportedBy'])
                  ->orderBy('created_at', 'desc');
        }]);
        
        // Apply role-based filtering for exports only
        if ($request->has('export_filter')) {
            if ($user->isTeacher()) {
                // Teachers can only export their department students
                $students = $students->where('grade', 'like', '%' . $user->department . '%')
                                   ->orWhere('grade', 'like', '%' . strtolower($user->department) . '%');
            }
        }
        
        // Text search filter
        if ($query) {
            $students = $students->where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('parent_name', 'like', "%{$query}%")
                  ->orWhere('parent_email', 'like', "%{$query}%")
                  ->orWhere('parent_phone', 'like', "%{$query}%")
                  ->orWhere('notes', 'like', "%{$query}%");
            });
        }
        
        // Grade filter
        if ($gradeFilter && $gradeFilter !== 'all') {
            $students = $students->where('grade', $gradeFilter);
        }
        
        // Status filter
        if ($statusFilter && $statusFilter !== 'all') {
            $students = $students->where('is_active', $statusFilter === 'active');
        }
        
        // Incident filter
        if ($incidentFilter && $incidentFilter !== 'all') {
            switch ($incidentFilter) {
                case 'with_incidents':
                    $students = $students->whereHas('incidents');
                    break;
                case 'with_active_incidents':
                    $students = $students->whereHas('incidents', function ($query) {
                        $query->where('status', 'open');
                    });
                    break;
                case 'without_incidents':
                    $students = $students->whereDoesntHave('incidents');
                    break;
                case 'with_resolved_incidents':
                    $students = $students->whereHas('incidents', function ($query) {
                        $query->where('status', 'resolved');
                    });
                    break;
                case 'with_escalated_incidents':
                    $students = $students->whereHas('incidents', function ($query) {
                        $query->where('status', 'escalated');
                    });
                    break;
            }
        }
        
        // Incident type filter
        if ($incidentTypeFilter && $incidentTypeFilter !== 'all') {
            $students = $students->whereHas('incidents', function ($query) use ($incidentTypeFilter) {
                $query->where('incident_type_id', $incidentTypeFilter);
            });
        }
        
        // Severity filter
        if ($severityFilter && $severityFilter !== 'all') {
            $students = $students->whereHas('incidents', function ($query) use ($severityFilter) {
                $query->where('severity', $severityFilter);
            });
        }
        
        // Date range filter
        if ($dateFrom || $dateTo) {
            $students = $students->whereHas('incidents', function ($query) use ($dateFrom, $dateTo) {
                if ($dateFrom) {
                    $query->where('created_at', '>=', $dateFrom);
                }
                if ($dateTo) {
                    $query->where('created_at', '<=', $dateTo . ' 23:59:59');
                }
            });
        }
        
        // Sorting
        $allowedSortFields = ['first_name', 'last_name', 'grade', 'created_at', 'incidents_count'];
        if (in_array($sortBy, $allowedSortFields)) {
            if ($sortBy === 'incidents_count') {
                $students = $students->withCount('incidents')->orderBy('incidents_count', $sortOrder);
            } else {
                $students = $students->orderBy($sortBy, $sortOrder);
            }
        } else {
            $students = $students->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }
        
        // Pagination
        $students = $students->active()->paginate($perPage);
        
        // Get filter options
        $grades = Student::distinct()->pluck('grade')->sortBy(function ($grade) {
            if ($grade === 'RR') return 0;
            if ($grade === 'R') return 1;
            return (int)$grade + 1;
        });
        
        $incidentTypes = IncidentType::orderBy('name')->get();
        $severities = ['minor', 'moderate', 'major', 'critical'];
        
        // Get statistics for current filter
        $totalStudents = Student::active()->count();
        $filteredCount = $students->total();
        
        return view('students.index', compact(
            'students',
            'query',
            'gradeFilter',
            'incidentFilter',
            'statusFilter',
            'dateFrom',
            'dateTo',
            'incidentTypeFilter',
            'severityFilter',
            'sortBy',
            'sortOrder',
            'perPage',
            'grades',
            'incidentTypes',
            'severities',
            'totalStudents',
            'filteredCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email',
            'grade' => 'required|string|in:RR,R,1,2,3,4,5,6,7,8,9,10,11,12',
            'parent_name' => 'required|string|max:255',
            'parent_email' => 'required|email',
            'parent_phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $student = Student::create($validated);

        \App\Services\AuditService::logDataModification('created', 'Student', $student->id, [
            'payload' => $validated,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        $student->load(['incidents' => function ($query) {
            $query->with(['incidentType', 'reportedBy'])
                  ->orderBy('created_at', 'desc');
        }, 'positiveReports' => function ($query) {
            $query->with(['positiveReportType', 'reportedBy'])
                  ->orderBy('created_at', 'desc');
        }]);

        // Get incident statistics
        $incidentStats = [
            'total' => $student->incidents()->count(),
            'open' => $student->incidents()->where('status', 'open')->count(),
            'resolved' => $student->incidents()->where('status', 'resolved')->count(),
            'escalated' => $student->incidents()->where('status', 'escalated')->count(),
        ];

        // Get incidents by type
        $incidentsByType = $student->incidents()
            ->with('incidentType')
            ->get()
            ->groupBy('incident_type_id')
            ->map(function ($incidents) {
                return [
                    'type' => $incidents->first()->incidentType->name,
                    'count' => $incidents->count(),
                    'incidents' => $incidents
                ];
            });

        return view('students.show', compact('student', 'incidentStats', 'incidentsByType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'grade' => 'required|string|in:RR,R,1,2,3,4,5,6,7,8,9,10,11,12',
            'parent_name' => 'required|string|max:255',
            'parent_email' => 'required|email',
            'parent_phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $student->update($validated);

        \App\Services\AuditService::logDataModification('updated', 'Student', $student->id, [
            'payload' => $validated,
        ]);

        return redirect()->route('students.show', $student)
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        // NEGATIVE SPACE: This should NEVER happen if our business logic is correct
        if ($student->hasActiveIncidents()) {
            $this->crash("Attempted to delete student with active incidents. "
                         . "StudentId: {$student->id}, ActiveIncidents: {$student->active_incidents_count}");
        }

        $studentId = $student->id;
        $student->delete();

        \App\Services\AuditService::logDataModification('deleted', 'Student', $studentId);

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }

    /**
     * Export filtered students in multiple formats
     */
    public function export(Request $request)
    {
        $user = auth()->user();
        $format = $request->get('format', 'excel');
        
        // Apply role-based filtering for exports
        $request->merge(['export_filter' => true]);
        $students = $this->getFilteredStudents($request);
        
        // Generate title based on filters
        $title = $this->generateExportTitle($request);
        
        switch ($format) {
            case 'excel':
                return Excel::download(
                    new StudentsExport($students, $title),
                    'students_' . now()->format('Y-m-d_H-i-s') . '.xlsx'
                );
                
            case 'pdf':
                $pdfService = new PDFExportService();
                return $pdfService->generateStudentsReport($students, $request->all());
                
            case 'csv':
                return $this->exportCSV($students);
                

                
            default:
                return Excel::download(
                    new StudentsExport($students, $title),
                    'students_' . now()->format('Y-m-d_H-i-s') . '.xlsx'
                );
        }
    }

    /**
     * Export student detail report
     */
    public function exportDetail(Student $student)
    {
        $pdfService = new PDFExportService();
        return $pdfService->generateStudentDetailReport($student);
    }

    /**
     * Export CSV (legacy method)
     */
    private function exportCSV($students)
    {
        $filename = 'students_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID', 'First Name', 'Last Name', 'Email', 'Grade', 
                'Parent Name', 'Parent Email', 'Parent Phone', 'Status',
                'Total Incidents', 'Active Incidents', 'Created Date'
            ]);
            
            // CSV data
            foreach ($students as $student) {
                fputcsv($file, [
                    $student->id,
                    $student->first_name,
                    $student->last_name,
                    $student->email,
                    $student->grade,
                    $student->parent_name,
                    $student->parent_email,
                    $student->parent_phone,
                    $student->is_active ? 'Active' : 'Inactive',
                    $student->incidents()->count(),
                    $student->incidents()->where('status', 'open')->count(),
                    $student->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Generate export title based on filters
     */
    private function generateExportTitle(Request $request)
    {
        $title = 'Students Report';
        $filters = [];
        
        if ($request->get('grade') && $request->get('grade') !== 'all') {
            $filters[] = 'Grade ' . $request->get('grade');
        }
        
        if ($request->get('has_incidents') && $request->get('has_incidents') !== 'all') {
            $filters[] = ucfirst(str_replace('_', ' ', $request->get('has_incidents')));
        }
        
        if ($request->get('status') && $request->get('status') !== 'all') {
            $filters[] = ucfirst($request->get('status'));
        }
        
        if ($request->get('q')) {
            $filters[] = 'Search: "' . $request->get('q') . '"';
        }
        
        if (!empty($filters)) {
            $title .= ' - ' . implode(', ', $filters);
        }
        
        return $title;
    }

    /**
     * Get filtered students query (helper method)
     */
    private function getFilteredStudents(Request $request)
    {
        $query = $request->get('q');
        $gradeFilter = $request->get('grade');
        $incidentFilter = $request->get('has_incidents');
        $statusFilter = $request->get('status');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $incidentTypeFilter = $request->get('incident_type');
        $severityFilter = $request->get('severity');
        
        $students = Student::with(['incidents' => function ($query) {
            $query->with(['incidentType', 'reportedBy']);
        }]);
        
        // Apply all filters (same logic as index method)
        if ($query) {
            $students = $students->where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                  ->orWhere('last_name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('parent_name', 'like', "%{$query}%")
                  ->orWhere('parent_email', 'like', "%{$query}%");
            });
        }
        
        if ($gradeFilter && $gradeFilter !== 'all') {
            $students = $students->where('grade', $gradeFilter);
        }
        
        if ($statusFilter && $statusFilter !== 'all') {
            $students = $students->where('is_active', $statusFilter === 'active');
        }
        
        if ($incidentFilter && $incidentFilter !== 'all') {
            switch ($incidentFilter) {
                case 'with_incidents':
                    $students = $students->whereHas('incidents');
                    break;
                case 'with_active_incidents':
                    $students = $students->whereHas('incidents', function ($query) {
                        $query->where('status', 'open');
                    });
                    break;
                case 'without_incidents':
                    $students = $students->whereDoesntHave('incidents');
                    break;
            }
        }
        
        if ($incidentTypeFilter && $incidentTypeFilter !== 'all') {
            $students = $students->whereHas('incidents', function ($query) use ($incidentTypeFilter) {
                $query->where('incident_type_id', $incidentTypeFilter);
            });
        }
        
        if ($severityFilter && $severityFilter !== 'all') {
            $students = $students->whereHas('incidents', function ($query) use ($severityFilter) {
                $query->where('severity', $severityFilter);
            });
        }
        
        if ($dateFrom || $dateTo) {
            $students = $students->whereHas('incidents', function ($query) use ($dateFrom, $dateTo) {
                if ($dateFrom) {
                    $query->where('created_at', '>=', $dateFrom);
                }
                if ($dateTo) {
                    $query->where('created_at', '<=', $dateTo . ' 23:59:59');
                }
            });
        }
        
        return $students->active()->orderBy('last_name')->orderBy('first_name')->get();
    }

    /**
     * Negative space programming helper
     */
    private function crash(string $message): never
    {
        $errorData = [
            'timestamp' => now()->toISOString(),
            'message' => $message,
            'request_url' => request()->fullUrl(),
            'user_id' => auth()->id() ?? 'unauthenticated',
        ];
        
        \Log::critical('INVARIANT VIOLATION', $errorData);
        
        throw new \Exception("INVARIANT VIOLATED: {$message}");
    }
}
