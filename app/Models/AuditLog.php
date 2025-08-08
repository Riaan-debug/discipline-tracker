<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_type',
        'event_category',
        'description',
        'metadata',
        'ip_address',
        'user_agent',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get the user that performed the action
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for authentication events
     */
    public function scopeAuthentication($query)
    {
        return $query->where('event_category', 'authentication');
    }

    /**
     * Scope for security events
     */
    public function scopeSecurity($query)
    {
        return $query->where('event_category', 'security');
    }

    /**
     * Scope for data access events
     */
    public function scopeDataAccess($query)
    {
        return $query->where('event_category', 'data_access');
    }

    /**
     * Scope for failed events
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope for successful events
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    /**
     * Get the user's name or 'Unknown' if no user
     */
    public function getUserNameAttribute(): string
    {
        return $this->user ? $this->user->name : 'Unknown User';
    }

    /**
     * Get the user's email or 'Unknown' if no user
     */
    public function getUserEmailAttribute(): string
    {
        return $this->user ? $this->user->email : 'Unknown Email';
    }

    /**
     * Get formatted created date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('M j, Y g:i A');
    }
}
