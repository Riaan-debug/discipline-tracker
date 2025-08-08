<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Models\Incident;
use App\Models\PositiveReport;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Console\Command;

class CleanDatabase extends Command
{
    protected $signature = 'db:clean {--force : Force the operation without confirmation}';
    protected $description = 'Clean all demo data from the database';

    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('This will delete ALL students, incidents, positive reports, and audit logs. Are you sure?')) {
                $this->info('Operation cancelled.');
                return;
            }
        }

        $this->info('Cleaning database...');

        // Delete all demo data
        $studentsCount = Student::count();
        $incidentsCount = Incident::count();
        $positiveReportsCount = PositiveReport::count();
        $auditLogsCount = AuditLog::count();
        
        // Delete demo users (keep only the production admin)
        $demoUsers = User::where('email', '!=', 'admin@school.edu')->delete();
        $usersCount = User::where('email', '!=', 'admin@school.edu')->count();

        Student::truncate();
        Incident::truncate();
        PositiveReport::truncate();
        AuditLog::truncate();

        $this->info("Deleted {$studentsCount} students");
        $this->info("Deleted {$incidentsCount} incidents");
        $this->info("Deleted {$positiveReportsCount} positive reports");
        $this->info("Deleted {$auditLogsCount} audit logs");
        $this->info("Deleted {$usersCount} demo users");

        $this->info('Database cleaned successfully!');
        $this->info('Run "php artisan db:seed --class=ProductionSeeder" to add production data.');
    }
}
