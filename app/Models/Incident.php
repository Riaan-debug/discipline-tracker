<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'reported_by',
        'incident_type_id',
        'description',
        'teacher_notes',
        'severity',
        'status',
        'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the student this incident belongs to
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the teacher who reported this incident
     */
    public function reportedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    /**
     * Get the incident type
     */
    public function incidentType(): BelongsTo
    {
        return $this->belongsTo(IncidentType::class);
    }

    /**
     * Scope for open incidents
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    /**
     * Scope for resolved incidents
     */
    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    /**
     * Scope for escalated incidents
     */
    public function scopeEscalated($query)
    {
        return $query->where('status', 'escalated');
    }

    /**
     * Resolve the incident
     */
    public function resolve(): void
    {
        // NEGATIVE SPACE: This should NEVER happen if our business logic is correct
        if ($this->status === 'resolved') {
            $this->crash("Attempted to resolve already resolved incident. "
                         . "IncidentId: {$this->id}, Status: {$this->status}");
        }

        if (empty(trim($this->description))) {
            $this->crash("Attempted to resolve incident without description. "
                         . "IncidentId: {$this->id}, Description: {$this->description}");
        }

        $this->update([
            'status' => 'resolved',
            'resolved_at' => now(),
        ]);
    }

    /**
     * Escalate the incident
     */
    public function escalate(): void
    {
        // NEGATIVE SPACE: This should NEVER happen if our business logic is correct
        if ($this->status === 'escalated') {
            $this->crash("Attempted to escalate already escalated incident. "
                         . "IncidentId: {$this->id}, Status: {$this->status}");
        }

        if ($this->status === 'resolved') {
            $this->crash("Attempted to escalate resolved incident. "
                         . "IncidentId: {$this->id}, Status: {$this->status}");
        }

        $this->update(['status' => 'escalated']);
    }

    /**
     * Negative space programming helper
     */
    private function crash(string $message): never
    {
        $errorData = [
            'timestamp' => now()->toISOString(),
            'message' => $message,
            'incident_id' => $this->id,
            'student_id' => $this->student_id,
            'status' => $this->status,
        ];
        
        Log::critical('INVARIANT VIOLATION', $errorData);
        
        throw new \Exception("INVARIANT VIOLATED: {$message}");
    }
}
