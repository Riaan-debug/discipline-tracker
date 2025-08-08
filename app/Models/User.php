<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the incidents reported by this user
     */
    public function reportedIncidents(): HasMany
    {
        return $this->hasMany(Incident::class, 'reported_by');
    }

    /**
     * Get the positive reports submitted by this user
     */
    public function submittedPositiveReports(): HasMany
    {
        return $this->hasMany(PositiveReport::class, 'reported_by');
    }

    /**
     * Check if user is an administrator
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a teacher
     */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    /**
     * Check if user is a counselor
     */
    public function isCounselor(): bool
    {
        return $this->role === 'counselor';
    }

    /**
     * Check if user is a principal
     */
    public function isPrincipal(): bool
    {
        return $this->role === 'principal';
    }

    /**
     * Check if user can manage incidents
     */
    public function canManageIncidents(): bool
    {
        return in_array($this->role, ['admin', 'teacher', 'counselor', 'principal']);
    }

    /**
     * Check if user can escalate incidents
     */
    public function canEscalateIncidents(): bool
    {
        return in_array($this->role, ['admin', 'counselor', 'principal']);
    }

    /**
     * Check if user can view all students
     */
    public function canViewAllStudents(): bool
    {
        return in_array($this->role, ['admin', 'counselor', 'principal']);
    }

    /**
     * Get user's display name
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Get user's role display name
     */
    public function getRoleDisplayNameAttribute(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'teacher' => 'Teacher',
            'counselor' => 'Counselor',
            'principal' => 'Principal',
            default => ucfirst($this->role ?? 'User'),
        };
    }
}
