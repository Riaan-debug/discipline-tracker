<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Incident;
use App\Models\IncidentType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class PDFExportService
{
    public function generateStudentsReport($students, $filters = [])
    {
        $data = [
            'students' => $students,
            'filters' => $filters,
            'statistics' => $this->getStatistics($students),
            'generated_at' => now(),
            'total_count' => $students->count(),
        ];

        $pdf = PDF::loadView('exports.students-pdf', $data);
        
        $filename = 'students_report_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function generateStudentDetailReport(Student $student)
    {
        $data = [
            'student' => $student,
            'incidents' => $student->incidents()->with(['incidentType', 'reportedBy'])->orderBy('created_at', 'desc')->get(),
            'positiveReports' => $student->positiveReports()->with(['positiveReportType', 'reportedBy'])->orderBy('created_at', 'desc')->get(),
            'statistics' => $this->getStudentStatistics($student),
            'generated_at' => now(),
        ];

        $pdf = PDF::loadView('exports.student-detail-pdf', $data);
        
        $filename = 'student_' . $student->id . '_report_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function generateIncidentsReport($incidents, $filters = [])
    {
        $data = [
            'incidents' => $incidents,
            'filters' => $filters,
            'statistics' => $this->getIncidentStatistics($incidents),
            'generated_at' => now(),
            'total_count' => $incidents->count(),
        ];

        $pdf = PDF::loadView('exports.incidents-pdf', $data);
        
        $filename = 'incidents_report_' . now()->format('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    private function getStatistics($students)
    {
        $totalStudents = $students->count();
        $activeStudents = $students->where('is_active', true)->count();
        $inactiveStudents = $totalStudents - $activeStudents;

        // Grade distribution
        $gradeDistribution = $students->groupBy('grade')->map(function ($group) {
            return $group->count();
        });

        // Incident statistics
        $studentsWithIncidents = $students->filter(function ($student) {
            return $student->incidents()->count() > 0;
        });

        $totalIncidents = $students->sum(function ($student) {
            return $student->incidents()->count();
        });

        $activeIncidents = $students->sum(function ($student) {
            return $student->incidents()->where('status', 'open')->count();
        });

        return [
            'total_students' => $totalStudents,
            'active_students' => $activeStudents,
            'inactive_students' => $inactiveStudents,
            'students_with_incidents' => $studentsWithIncidents->count(),
            'students_without_incidents' => $totalStudents - $studentsWithIncidents->count(),
            'total_incidents' => $totalIncidents,
            'active_incidents' => $activeIncidents,
            'grade_distribution' => $gradeDistribution,
        ];
    }

    private function getStudentStatistics(Student $student)
    {
        $incidents = $student->incidents();
        $positiveReports = $student->positiveReports();

        return [
            'total_incidents' => $incidents->count(),
            'active_incidents' => $incidents->where('status', 'open')->count(),
            'resolved_incidents' => $incidents->where('status', 'resolved')->count(),
            'escalated_incidents' => $incidents->where('status', 'escalated')->count(),
            'total_positive_reports' => $positiveReports->count(),
            'incidents_by_type' => $incidents->with('incidentType')->get()->groupBy('incident_type_id'),
            'incidents_by_severity' => $incidents->get()->groupBy('severity'),
            'member_since' => $student->created_at->format('F Y'),
            'days_as_member' => $student->created_at->diffInDays(now()),
        ];
    }

    private function getIncidentStatistics($incidents)
    {
        $totalIncidents = $incidents->count();
        $openIncidents = $incidents->where('status', 'open')->count();
        $resolvedIncidents = $incidents->where('status', 'resolved')->count();
        $escalatedIncidents = $incidents->where('status', 'escalated')->count();

        // Severity distribution
        $severityDistribution = $incidents->groupBy('severity')->map(function ($group) {
            return $group->count();
        });

        // Type distribution
        $typeDistribution = $incidents->groupBy('incident_type_id')->map(function ($group) {
            return $group->count();
        });

        return [
            'total_incidents' => $totalIncidents,
            'open_incidents' => $openIncidents,
            'resolved_incidents' => $resolvedIncidents,
            'escalated_incidents' => $escalatedIncidents,
            'severity_distribution' => $severityDistribution,
            'type_distribution' => $typeDistribution,
        ];
    }
} 