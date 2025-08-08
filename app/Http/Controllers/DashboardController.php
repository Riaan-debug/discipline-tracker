<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Incident;
use App\Models\PositiveReport;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with overview statistics.
     */
    public function index(): View
    {
        // Get basic statistics
        $totalStudents = Student::active()->count();
        $totalIncidents = Incident::count();
        $activeIncidents = Incident::where('status', 'open')->count();
        $totalPositiveReports = PositiveReport::count();
        
        // Get incidents by grade (all incidents, not just active)
        $incidentsByGrade = Student::withCount('incidents')
        ->active()
        ->get()
        ->groupBy('grade')
        ->map(function ($students) {
            return $students->sum('incidents_count');
        })
        ->sortBy(function ($count, $grade) {
            if ($grade === 'RR') return 0;
            if ($grade === 'R') return 1;
            return (int)$grade + 1; // Add 1 to ensure RR and R come before numeric grades
        });
        
        // Get recent activity (last 7 days)
        $recentIncidents = Incident::with(['student', 'incidentType'])
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentPositiveReports = PositiveReport::with(['student', 'positiveReportType'])
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get grade with most incidents
        $gradeWithMostIncidents = $incidentsByGrade->sortDesc()->keys()->first();
        
        return view('dashboard.index', compact(
            'totalStudents',
            'totalIncidents', 
            'activeIncidents',
            'totalPositiveReports',
            'incidentsByGrade',
            'recentIncidents',
            'recentPositiveReports',
            'gradeWithMostIncidents'
        ));
    }
}
