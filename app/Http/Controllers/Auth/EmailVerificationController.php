<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    /**
     * Show the email verification notice
     */
    public function show()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard.index');
        }

        return view('auth.verify-email');
    }

    /**
     * Send a new email verification link
     */
    public function send(Request $request)
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard.index');
        }

        Auth::user()->sendEmailVerificationNotification();

        // Log email verification request
        AuditService::logEmailVerification(Auth::user()->email, 'success');

        return back()->with('status', 'Verification link sent!');
    }

    /**
     * Verify the user's email address
     */
    public function verify(Request $request, $id, $hash)
    {
        $user = \App\Models\User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            AuditService::logEmailVerification($user->email, 'failed', ['reason' => 'invalid_hash']);
            abort(403, 'Invalid verification link.');
        }

        if ($user->hasVerifiedEmail()) {
            AuditService::logEmailVerification($user->email, 'failed', ['reason' => 'already_verified']);
            return redirect()->route('dashboard.index')->with('status', 'Email already verified!');
        }

        $user->markEmailAsVerified();

        // Log successful email verification
        AuditService::logEmailVerification($user->email, 'success', ['action' => 'verified']);

        return redirect()->route('dashboard.index')->with('status', 'Email verified successfully!');
    }
}
