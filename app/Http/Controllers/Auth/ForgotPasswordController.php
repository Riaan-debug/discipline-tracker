<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /**
     * Show the forgot password form
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a reset link to the given user
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Check if user exists and is active
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if (!$user) {
            AuditService::logPasswordReset($request->email, 'failed', ['reason' => 'user_not_found']);
            throw ValidationException::withMessages([
                'email' => 'We can\'t find a user with that email address.',
            ]);
        }

        if (!$user->is_active) {
            AuditService::logPasswordReset($request->email, 'failed', ['reason' => 'account_deactivated']);
            throw ValidationException::withMessages([
                'email' => 'This account has been deactivated. Please contact an administrator.',
            ]);
        }

        // Send the password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            AuditService::logPasswordReset($request->email, 'success');
            return back()->with('status', __($status));
        }

        AuditService::logPasswordReset($request->email, 'failed', ['reason' => 'send_failed']);
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
