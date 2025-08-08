<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class TestEmailVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email-verification {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email verification functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("Testing email verification for: {$email}");
        $this->line('');
        
        // Check if user exists
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("❌ User not found with email: {$email}");
            return 1;
        }
        
        $this->info("✅ User found: {$user->name} ({$user->role})");
        
        // Check email verification status
        if ($user->hasVerifiedEmail()) {
            $this->info("✅ Email is verified");
            $this->info("📅 Verified at: " . $user->email_verified_at->format('Y-m-d H:i:s'));
        } else {
            $this->warn("⚠️  Email is NOT verified");
            $this->line('');
            $this->info("🔄 Sending verification email...");
            
            try {
                $user->sendEmailVerificationNotification();
                $this->info("✅ Verification email sent successfully!");
                $this->line('');
                $this->info("📧 Check your email for the verification link");
                $this->info("🔗 Verification URL format:");
                $this->line("https://discipline-tracker.test/email/verify/{$user->id}/{hash}?email={$email}");
            } catch (\Exception $e) {
                $this->error("❌ Error sending verification email: " . $e->getMessage());
            }
        }
        
        return 0;
    }
}
