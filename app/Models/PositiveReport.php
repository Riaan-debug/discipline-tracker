<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositiveReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'positive_report_type_id',
        'description',
        'teacher_notes',
        'reported_by',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all active positive reports
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the student for this positive report
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the positive report type for this report
     */
    public function positiveReportType()
    {
        return $this->belongsTo(PositiveReportType::class);
    }

    /**
     * Get the user who reported this positive behavior
     */
    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
} 