<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class TestPasswordReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:password-reset {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test password reset functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("Testing password reset for: {$email}");
        $this->line('');
        
        // Check if user exists
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("❌ User not found with email: {$email}");
            return 1;
        }
        
        $this->info("✅ User found: {$user->name} ({$user->role})");
        
        if (!$user->is_active) {
            $this->error("❌ User account is deactivated");
            return 1;
        }
        
        $this->info("✅ User account is active");
        $this->line('');
        
        // Test password reset
        $this->info("🔄 Sending password reset link...");
        
        try {
            $status = Password::sendResetLink(['email' => $email]);
            
            if ($status === Password::RESET_LINK_SENT) {
                $this->info("✅ Password reset link sent successfully!");
                $this->line('');
                $this->info("📧 Check your email for the reset link");
                $this->info("📧 Or check Laravel logs for email details");
                $this->line('');
                $this->info("🔗 Reset URL format:");
                $this->line("https://discipline-tracker.test/reset-password/{token}?email={$email}");
            } else {
                $this->error("❌ Failed to send reset link: " . trans($status));
            }
            
        } catch (\Exception $e) {
            $this->error("❌ Error sending reset link: " . $e->getMessage());
            $this->line('');
            $this->info("🔧 This might be due to:");
            $this->line("   - Gmail SMTP configuration");
            $this->line("   - App password not set correctly");
            $this->line("   - Network connectivity issues");
        }
        
        return 0;
    }
}
