<?php

namespace App\Http\Controllers;

use App\Models\PositiveReport;
use App\Models\PositiveReportType;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PositiveReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $positiveReports = PositiveReport::with(['student', 'positiveReportType', 'reportedBy'])
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();

        // Group by date
        $groupedReports = $positiveReports->groupBy(function($report) {
            $date = $report->created_at;
            if ($date->isToday()) return 'Today';
            if ($date->isYesterday()) return 'Yesterday';
            if ($date->weekOfYear === now()->weekOfYear && $date->year === now()->year) return 'This Week';
            if ($date->month === now()->month && $date->year === now()->year) return 'This Month';
            return 'Older';
        });

        return view('positive-reports.index', compact('groupedReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $students = Student::active()->orderBy('last_name')->get();
        $positiveReportTypes = PositiveReportType::active()->orderBy('name')->get();
        
        // Pre-select student if coming from student profile
        $selectedStudentId = $request->get('student_id');

        return view('positive-reports.create', compact('students', 'positiveReportTypes', 'selectedStudentId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'positive_report_type_id' => 'required|exists:positive_report_types,id',
            'description' => 'required|string|min:10',
            'teacher_notes' => 'nullable|string',
        ]);

        $positiveReport = PositiveReport::create([
            ...$validated,
            'reported_by' => auth()->id() ?? 1, // Default to user ID 1 if no auth
            'status' => 'active',
        ]);

        \App\Services\AuditService::logDataModification('created', 'PositiveReport', $positiveReport->id, [
            'student_id' => $positiveReport->student_id,
            'type_id' => $positiveReport->positive_report_type_id,
        ]);

        return redirect()->route('positive-reports.show', $positiveReport)
            ->with('success', 'Positive report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PositiveReport $positiveReport): View
    {
        $positiveReport->load(['student', 'positiveReportType', 'reportedBy']);

        return view('positive-reports.show', compact('positiveReport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PositiveReport $positiveReport): View
    {
        $students = Student::active()->orderBy('last_name')->get();
        $positiveReportTypes = PositiveReportType::active()->orderBy('name')->get();

        return view('positive-reports.edit', compact('positiveReport', 'students', 'positiveReportTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PositiveReport $positiveReport): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'positive_report_type_id' => 'required|exists:positive_report_types,id',
            'description' => 'required|string|min:10',
            'teacher_notes' => 'nullable|string',
        ]);

        $positiveReport->update($validated);

        \App\Services\AuditService::logDataModification('updated', 'PositiveReport', $positiveReport->id);

        return redirect()->route('positive-reports.show', $positiveReport)
            ->with('success', 'Positive report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PositiveReport $positiveReport): RedirectResponse
    {
        $positiveReport->update(['status' => 'archived']);
        \App\Services\AuditService::logDataModification('archived', 'PositiveReport', $positiveReport->id);

        return redirect()->route('positive-reports.index')
            ->with('success', 'Positive report archived successfully.');
    }
} 