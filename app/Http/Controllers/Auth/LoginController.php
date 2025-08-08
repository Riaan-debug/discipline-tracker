<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Check if user is active
            if (!Auth::user()->is_active) {
                Auth::logout();
                AuditService::logLogin($credentials['email'], 'failed', ['reason' => 'account_deactivated']);
                throw ValidationException::withMessages([
                    'email' => 'Your account has been deactivated. Please contact an administrator.',
                ]);
            }

            // Log successful login
            AuditService::logLogin($credentials['email'], 'success');

            return redirect()->intended(route('dashboard.index'));
        }

        // Log failed login attempt
        AuditService::logLogin($credentials['email'], 'failed', ['reason' => 'invalid_credentials']);

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle the logout request
     */
    public function logout(Request $request)
    {
        // Log logout before actually logging out
        AuditService::logLogout();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
} 