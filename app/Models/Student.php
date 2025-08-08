<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'grade',
        'parent_name',
        'parent_email',
        'parent_phone',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'grade' => 'string',
    ];

    /**
     * Get the incidents for this student
     */
    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class);
    }

    /**
     * Get the positive reports for this student
     */
    public function positiveReports(): HasMany
    {
        return $this->hasMany(PositiveReport::class);
    }

    /**
     * Get the student's full name
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get active incidents count
     */
    public function getActiveIncidentsCountAttribute(): int
    {
        return $this->incidents()->where('status', 'open')->count();
    }

    /**
     * Check if student has active incidents
     */
    public function hasActiveIncidents(): bool
    {
        return $this->active_incidents_count > 0;
    }

    /**
     * Get total incidents count
     */
    public function getTotalIncidentsCountAttribute(): int
    {
        return $this->incidents()->count();
    }

    /**
     * Scope for active students
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for students by grade
     */
    public function scopeByGrade($query, string $grade)
    {
        return $query->where('grade', $grade);
    }
}
