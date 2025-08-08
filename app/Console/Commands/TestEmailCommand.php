<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmailNotificationService;
use App\Models\Student;
use App\Models\Incident;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {student_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the email notification system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $studentId = $this->argument('student_id');
        
        if ($studentId) {
            $student = Student::find($studentId);
            if (!$student) {
                $this->error("Student with ID {$studentId} not found.");
                return 1;
            }
        } else {
            $student = Student::with('incidents')->first();
            if (!$student) {
                $this->error("No students found in the database.");
                return 1;
            }
        }

        $this->info("Testing email system for: {$student->full_name}");
        $this->info("Total incidents: {$student->incidents->count()}");
        $this->info("Parent email: {$student->parent_email}");
        
        if (empty($student->parent_email)) {
            $this->error("No parent email address found for this student.");
            return 1;
        }

        $emailService = new EmailNotificationService();
        $status = $emailService->getEscalationStatus($student);
        
        $this->info("Escalation status:");
        $this->table(
            ['Metric', 'Value'],
            [
                ['Total Incidents', $status['total_incidents']],
                ['Warning Sent (3+)', $status['warning_sent'] ? 'Yes' : 'No'],
                ['Escalation Sent (6+)', $status['escalation_sent'] ? 'Yes' : 'No'],
                ['Hearing Required (9+)', $status['hearing_required'] ? 'Yes' : 'No'],
                ['Next Threshold', $status['next_threshold'] ?? 'None'],
            ]
        );

        if ($status['total_incidents'] >= 3) {
            $this->info("This student should have received emails at the appropriate thresholds.");
            $this->info("Check your email logs or inbox for emails sent to: {$student->parent_email}");
        } else {
            $this->info("This student has not reached the first email threshold (3 incidents).");
        }

        // Test actual email sending
        $this->info("\n🧪 Testing actual email sending...");
        $this->info("Mail driver: " . config('mail.default'));
        $this->info("Mail host: " . config('mail.mailers.smtp.host'));
        $this->info("Mail port: " . config('mail.mailers.smtp.port'));
        $this->info("Mail username: " . config('mail.mailers.smtp.username'));
        $this->info("Mail encryption: " . config('mail.mailers.smtp.encryption'));
        
        try {
            \Mail::raw('This is a test email from the discipline system. If you receive this, email sending is working!', function ($message) use ($student) {
                $message->to($student->parent_email)
                        ->subject('🧪 Test Email - Discipline System')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
            
            $this->info("✅ Test email sent successfully!");
            $this->info("Check your inbox (and spam folder) for: {$student->parent_email}");
            
        } catch (\Exception $e) {
            $this->error("❌ Email sending failed: " . $e->getMessage());
            $this->error("Error details: " . $e->getTraceAsString());
        }

        return 0;
    }
} 