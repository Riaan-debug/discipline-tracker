<?php

namespace App\Console\Commands;

use App\Mail\MonthlySummaryEmail;
use App\Models\Student;
use App\Models\Incident;
use App\Models\PositiveReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendMonthlySummaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-monthly-summaries {--month= : Specific month (YYYY-MM format)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send monthly summary emails to all active students\' parents';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $month = $this->option('month') ? Carbon::parse($this->option('month')) : now()->subMonth();
        $monthYear = $month->format('F Y');
        
        $this->info("Sending monthly summaries for {$monthYear}...");
        
        $students = Student::active()->whereNotNull('parent_email')->get();
        $sentCount = 0;
        
        foreach ($students as $student) {
            // Get incidents for the month
            $incidents = Incident::where('student_id', $student->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->with('incidentType')
                ->get();
                
            // Get positive reports for the month
            $positiveReports = PositiveReport::where('student_id', $student->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->with('positiveReportType')
                ->get();
            
            // Calculate grade statistics
            $gradeStats = $this->calculateGradeStats($student, $month);
            
            // Send email
            try {
                Mail::to($student->parent_email)
                    ->send(new MonthlySummaryEmail(
                        $student,
                        $incidents,
                        $positiveReports,
                        $gradeStats,
                        $monthYear
                    ));
                    
                $sentCount++;
                $this->line("✓ Sent to {$student->parent_name} ({$student->parent_email})");
            } catch (\Exception $e) {
                $this->error("✗ Failed to send to {$student->parent_name}: {$e->getMessage()}");
            }
        }
        
        $this->info("Completed! Sent {$sentCount} out of {$students->count()} emails.");
    }
    
    private function calculateGradeStats(Student $student, Carbon $month): ?array
    {
        $gradeStudents = Student::active()
            ->where('grade', $student->grade)
            ->get();
            
        if ($gradeStudents->count() < 2) {
            return null; // Not enough students for comparison
        }
        
        $gradeIncidents = Incident::whereIn('student_id', $gradeStudents->pluck('id'))
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->count();
            
        $avgIncidents = $gradeStudents->count() > 0 ? round($gradeIncidents / $gradeStudents->count(), 1) : 0;
        
        // Calculate student's position (lower is better)
        $studentIncidentCount = Incident::where('student_id', $student->id)
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->count();
            
        $position = $gradeStudents->filter(function ($s) use ($studentIncidentCount, $month) {
            $sIncidentCount = Incident::where('student_id', $s->id)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            return $sIncidentCount <= $studentIncidentCount;
        })->count();
        
        return [
            'avg_incidents' => $avgIncidents,
            'position' => $position,
            'total_students' => $gradeStudents->count(),
        ];
    }
}
