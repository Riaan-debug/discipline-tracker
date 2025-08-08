<?php

namespace App\Console\Commands;

use App\Models\Incident;
use App\Services\EmailNotificationService;
use Illuminate\Console\Command;

class TestCriticalEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:critical-email {student_name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test critical incident email for a specific student';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $studentName = $this->argument('student_name') ?? 'Rob Blob';
        
        // Find the student
        $names = explode(' ', $studentName);
        $student = \App\Models\Student::where('first_name', $names[0])
            ->where('last_name', $names[1] ?? '')
            ->first();

        if (!$student) {
            $this->error("Student not found: {$studentName}");
            return 1;
        }

        $this->info("Testing critical incident email for: {$student->full_name}");
        $this->info("Parent email: {$student->parent_email}");
        
        // Find the most recent critical incident
        $criticalIncident = $student->incidents()
            ->where('severity', 'critical')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$criticalIncident) {
            $this->error("No critical incidents found for {$student->full_name}");
            return 1;
        }

        $this->info("Found critical incident: {$criticalIncident->incidentType->name} on {$criticalIncident->created_at->format('M j, Y g:i A')}");

        // Manually trigger the email
        $emailService = new EmailNotificationService();
        $emailService->checkForEscalation($criticalIncident);

        $this->info("✅ Critical incident email sent to: {$student->parent_email}");
        $this->info("Check your inbox (and spam folder) for the email.");

        return 0;
    }
} 