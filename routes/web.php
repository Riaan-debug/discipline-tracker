<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\PositiveReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\IncidentTypeController;
use App\Http\Controllers\PositiveReportTypeController;
use App\Http\Controllers\UserController;

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('rate.limit.auth');
    
    // Password reset routes
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('rate.limit.auth');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update')->middleware('rate.limit.auth');
});

Route::middleware(['auth', 'ensure.user.active'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Email verification routes
    Route::get('/email/verify', [EmailVerificationController::class, 'show'])->name('verification.notice');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])->name('verification.send')->middleware('rate.limit.auth');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Main application routes
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });

    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Student routes
    Route::get('students/export', [StudentController::class, 'export'])->name('students.export');
    Route::get('students/{student}/export', [StudentController::class, 'exportDetail'])->name('students.export-detail');
    Route::resource('students', StudentController::class);

    // Incident routes
    Route::resource('incidents', IncidentController::class);
    Route::patch('incidents/{incident}/resolve', [IncidentController::class, 'resolve'])->name('incidents.resolve')->middleware('role:management');
    Route::patch('incidents/{incident}/escalate', [IncidentController::class, 'escalate'])->name('incidents.escalate')->middleware('role:management');
    Route::post('incidents/{incident}/notes', [IncidentController::class, 'addNotes'])->name('incidents.add-notes');

    // Positive Report routes
    Route::resource('positive-reports', PositiveReportController::class);
    
    // Incident Type Management (Admin/Principal only)
    Route::resource('incident-types', IncidentTypeController::class)->middleware('role:admin,principal');
    
    // Positive Report Type Management (Admin/Principal only)
    Route::resource('positive-report-types', PositiveReportTypeController::class)->middleware('role:admin,principal');
    
    // User Management (Admin only)
    Route::resource('users', UserController::class)->middleware('role:admin');
    
    // Audit Log routes (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
        Route::get('/audit-logs/{auditLog}', [AuditLogController::class, 'show'])->name('audit-logs.show');
        Route::get('/audit-logs/export', [AuditLogController::class, 'export'])->name('audit-logs.export');
    });
    
    // Help Documentation routes
    Route::get('/help', [HelpController::class, 'index'])->name('help.index');
    Route::get('/help/getting-started', [HelpController::class, 'gettingStarted'])->name('help.getting-started');
    Route::get('/help/user-roles', [HelpController::class, 'userRoles'])->name('help.user-roles');
    Route::get('/help/students', [HelpController::class, 'students'])->name('help.students');
    Route::get('/help/incidents', [HelpController::class, 'incidents'])->name('help.incidents');
    Route::get('/help/positive-reports', [HelpController::class, 'positiveReports'])->name('help.positive-reports');
    Route::get('/help/exports', [HelpController::class, 'exports'])->name('help.exports');
    Route::get('/help/faq', [HelpController::class, 'faq'])->name('help.faq');
    Route::get('/help/support', [HelpController::class, 'support'])->name('help.support');
});

// Settings routes (Admin & Principal only)
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/reset', [SettingsController::class, 'reset'])->name('settings.reset');
});
