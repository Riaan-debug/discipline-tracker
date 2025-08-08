<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditService
{
    /**
     * Log an authentication event
     */
    public static function logAuthentication(string $eventType, string $description, string $status = 'success', array $metadata = []): void
    {
        self::log($eventType, 'authentication', $description, $status, $metadata);
    }

    /**
     * Log a security event
     */
    public static function logSecurity(string $eventType, string $description, string $status = 'success', array $metadata = []): void
    {
        self::log($eventType, 'security', $description, $status, $metadata);
    }

    /**
     * Log a data access event
     */
    public static function logDataAccess(string $eventType, string $description, string $status = 'success', array $metadata = []): void
    {
        self::log($eventType, 'data_access', $description, $status, $metadata);
    }

    /**
     * Log a user login event
     */
    public static function logLogin(string $email, string $status = 'success', array $metadata = []): void
    {
        $user = Auth::user();
        $description = $status === 'success' 
            ? "User logged in successfully" 
            : "Failed login attempt for email: {$email}";
        
        self::logAuthentication('login', $description, $status, array_merge([
            'email' => $email,
            'user_id' => $user?->id,
        ], $metadata));
    }

    /**
     * Log a user logout event
     */
    public static function logLogout(): void
    {
        $user = Auth::user();
        self::logAuthentication('logout', "User logged out", 'success', [
            'user_id' => $user?->id,
        ]);
    }

    /**
     * Log a password reset event
     */
    public static function logPasswordReset(string $email, string $status = 'success', array $metadata = []): void
    {
        $description = $status === 'success' 
            ? "Password reset requested for email: {$email}" 
            : "Failed password reset attempt for email: {$email}";
        
        self::logSecurity('password_reset', $description, $status, array_merge([
            'email' => $email,
        ], $metadata));
    }

    /**
     * Log an email verification event
     */
    public static function logEmailVerification(string $email, string $status = 'success', array $metadata = []): void
    {
        $description = $status === 'success' 
            ? "Email verification sent to: {$email}" 
            : "Failed email verification for: {$email}";
        
        self::logSecurity('email_verification', $description, $status, array_merge([
            'email' => $email,
        ], $metadata));
    }

    /**
     * Log a rate limit event
     */
    public static function logRateLimit(string $action, string $identifier, array $metadata = []): void
    {
        self::logSecurity('rate_limit', "Rate limit exceeded for {$action}", 'warning', array_merge([
            'action' => $action,
            'identifier' => $identifier,
        ], $metadata));
    }

    /**
     * Log a data export event
     */
    public static function logDataExport(string $type, string $format, array $metadata = []): void
    {
        $user = Auth::user();
        self::logDataAccess('data_export', "Data exported: {$type} in {$format} format", 'success', array_merge([
            'export_type' => $type,
            'export_format' => $format,
            'user_id' => $user?->id,
        ], $metadata));
    }

    /**
     * Log a data modification event
     */
    public static function logDataModification(string $action, string $model, int $recordId, array $metadata = []): void
    {
        $user = Auth::user();
        self::logDataAccess('data_modification', "{$action} {$model} record #{$recordId}", 'success', array_merge([
            'action' => $action,
            'model' => $model,
            'record_id' => $recordId,
            'user_id' => $user?->id,
        ], $metadata));
    }

    /**
     * Main logging method
     */
    protected static function log(string $eventType, string $category, string $description, string $status, array $metadata = []): void
    {
        $request = request();
        
        AuditLog::create([
            'user_id' => Auth::id(),
            'event_type' => $eventType,
            'event_category' => $category,
            'description' => $description,
            'metadata' => $metadata,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => $status,
        ]);
    }
} 