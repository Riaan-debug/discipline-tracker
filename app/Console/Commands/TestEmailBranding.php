<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\ImmediateIncidentEmail;
use App\Models\Student;
use App\Models\Incident;
use App\Services\BrandingService;
use Illuminate\Support\Facades\Mail;

class TestEmailBranding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email-branding {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email branding by sending a test email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        // Get branding settings
        $branding = BrandingService::getSettings();
        
        $this->info('Current Branding Settings:');
        $this->table(['Setting', 'Value'], [
            ['School Name', $branding['school_name'] ?? 'Not set'],
            ['Logo Path', $branding['logo_path'] ?? 'Not set'],
            ['Primary Color', $branding['primary_color'] ?? 'Not set'],
            ['School Phone', $branding['school_phone'] ?? 'Not set'],
            ['School Email', $branding['school_email'] ?? 'Not set'],
        ]);
        
        // Get first student and incident for testing
        $student = Student::first();
        $incident = Incident::first();
        
        if (!$student || !$incident) {
            $this->error('No students or incidents found. Please seed the database first.');
            return 1;
        }
        
        $this->info("Sending test email to: {$email}");
        $this->info("Using student: {$student->full_name}");
        $this->info("Using incident: {$incident->description}");
        
        try {
            Mail::to($email)->send(new ImmediateIncidentEmail($student, [$incident], $incident));
            $this->info('✅ Test email sent successfully!');
            $this->info('Check your email to see if the branding is working correctly.');
        } catch (\Exception $e) {
            $this->error('❌ Failed to send test email: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
} 