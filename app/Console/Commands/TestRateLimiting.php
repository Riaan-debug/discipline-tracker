<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\RateLimiter;

class TestRateLimiting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:rate-limiting {action=login} {email=test@example.com}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test rate limiting functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $email = $this->argument('email');
        
        $this->info("Testing rate limiting for: {$action}");
        $this->info("Email: {$email}");
        $this->line('');
        
        // Simulate the rate limiting key generation
        $key = $this->generateRateLimitKey($action, $email);
        
        $this->info("Rate limit key: " . substr($key, 0, 20) . "...");
        $this->line('');
        
        // Test rate limiting
        $maxAttempts = 5;
        $this->info("Max attempts: {$maxAttempts}");
        $this->info("Window: 15 minutes");
        $this->line('');
        
        // Check current status
        $remaining = RateLimiter::remaining($key, $maxAttempts);
        $this->info("Remaining attempts: {$remaining}");
        
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $retryAfter = RateLimiter::availableIn($key);
            $this->error("❌ Rate limit exceeded!");
            $this->error("Retry after: {$retryAfter} seconds");
            $this->error("Available at: " . now()->addSeconds($retryAfter)->format('Y-m-d H:i:s'));
        } else {
            $this->info("✅ Rate limit not exceeded");
            
            // Simulate a hit
            RateLimiter::hit($key, 15 * 60); // 15 minutes
            $this->info("✅ Hit recorded");
            
            $remaining = RateLimiter::remaining($key, $maxAttempts);
            $this->info("Remaining attempts after hit: {$remaining}");
        }
        
        $this->line('');
        $this->info("🔧 To clear rate limits for testing:");
        $this->line("php artisan tinker --execute=\"RateLimiter::clear('{$key}');\"");
        
        return 0;
    }
    
    /**
     * Generate rate limit key (same as middleware)
     */
    protected function generateRateLimitKey(string $action, string $email): string
    {
        $identifier = '127.0.0.1|' . $email;
        return sha1($identifier . '|' . $action);
    }
}
