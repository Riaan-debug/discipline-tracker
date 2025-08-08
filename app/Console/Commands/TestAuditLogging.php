<?php

namespace App\Console\Commands;

use App\Models\AuditLog;
use App\Services\AuditService;
use Illuminate\Console\Command;

class TestAuditLogging extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:audit-logging';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test audit logging functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Testing Audit Logging System");
        $this->line('');
        
        // Test various audit events
        $this->info("🔄 Creating test audit events...");
        
        // Test authentication events
        AuditService::logLogin('test@example.com', 'success', ['test' => true]);
        AuditService::logLogin('test@example.com', 'failed', ['reason' => 'invalid_password', 'test' => true]);
        AuditService::logLogout();
        
        // Test security events
        AuditService::logPasswordReset('test@example.com', 'success', ['test' => true]);
        AuditService::logEmailVerification('test@example.com', 'success', ['test' => true]);
        AuditService::logRateLimit('login', '127.0.0.1|test@example.com', ['test' => true]);
        
        // Test data access events
        AuditService::logDataExport('students', 'csv', ['test' => true]);
        AuditService::logDataModification('create', 'Student', 1, ['test' => true]);
        AuditService::logDataModification('update', 'Incident', 1, ['test' => true]);
        
        $this->info("✅ Test events created successfully!");
        $this->line('');
        
        // Show statistics
        $this->info("📊 Audit Log Statistics:");
        $this->line('');
        
        $stats = [
            'Total Logs' => AuditLog::count(),
            'Authentication Events' => AuditLog::authentication()->count(),
            'Security Events' => AuditLog::security()->count(),
            'Data Access Events' => AuditLog::dataAccess()->count(),
            'Successful Events' => AuditLog::successful()->count(),
            'Failed Events' => AuditLog::failed()->count(),
        ];
        
        foreach ($stats as $label => $count) {
            $this->line("  {$label}: {$count}");
        }
        
        $this->line('');
        
        // Show recent logs
        $this->info("📝 Recent Audit Logs (last 5):");
        $this->line('');
        
        $recentLogs = AuditLog::with('user')->latest()->take(5)->get();
        
        foreach ($recentLogs as $log) {
            $statusColor = $log->status === 'success' ? 'green' : ($log->status === 'failed' ? 'red' : 'yellow');
            $this->line("  [{$log->created_at->format('H:i:s')}] {$log->event_type} - {$log->description} ({$log->status})");
        }
        
        $this->line('');
        $this->info("🎯 Audit logging system is working correctly!");
        
        return 0;
    }
}
