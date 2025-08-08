<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Incident;
use App\Mail\IncidentWarningEmail;
use App\Mail\IncidentEscalationEmail;
use App\Mail\DisciplinaryHearingEmail;
use App\Mail\ImmediateIncidentEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailNotificationService
{
    /**
     * Check if an incident should trigger an email notification
     */
    public function checkForEscalation(Incident $incident): void
    {
        $student = $incident->student;
        $totalIncidents = $student->incidents()->count();
        
        // Get all incidents for the student (for email content)
        $incidents = $student->incidents()
            ->with(['incidentType', 'reportedBy'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Send immediate email for critical incidents
        if ($incident->severity === 'critical') {
            $this->sendCriticalIncidentEmail($student, $incidents, $incident);
        }

        // Check escalation thresholds
        switch ($totalIncidents) {
            case 3:
                $this->sendWarningEmail($student, $incidents, $incident);
                break;
            case 6:
                $this->sendEscalationEmail($student, $incidents, $incident);
                break;
            case 9:
                $this->sendDisciplinaryHearingEmail($student, $incidents, $incident);
                break;
        }
    }

    /**
     * Send warning email (3 incidents)
     */
    private function sendWarningEmail(Student $student, $incidents, Incident $latestIncident): void
    {
        try {
            if (empty($student->parent_email)) {
                Log::warning("Cannot send warning email: No parent email for student {$student->id}");
                return;
            }

            Mail::to($student->parent_email)
                ->send(new IncidentWarningEmail($student, $incidents, $latestIncident));

            Log::info("Warning email sent to {$student->parent_email} for student {$student->id}");

        } catch (\Exception $e) {
            Log::error("Failed to send warning email for student {$student->id}: " . $e->getMessage());
        }
    }

    /**
     * Send escalation email (6 incidents)
     */
    private function sendEscalationEmail(Student $student, $incidents, Incident $latestIncident): void
    {
        try {
            if (empty($student->parent_email)) {
                Log::warning("Cannot send escalation email: No parent email for student {$student->id}");
                return;
            }

            Mail::to($student->parent_email)
                ->send(new IncidentEscalationEmail($student, $incidents, $latestIncident));

            Log::info("Escalation email sent to {$student->parent_email} for student {$student->id}");

        } catch (\Exception $e) {
            Log::error("Failed to send escalation email for student {$student->id}: " . $e->getMessage());
        }
    }

    /**
     * Send critical incident email (immediate)
     */
    private function sendCriticalIncidentEmail(Student $student, $incidents, Incident $latestIncident): void
    {
        try {
            if (empty($student->parent_email)) {
                Log::warning("Cannot send critical incident email: No parent email for student {$student->id}");
                return;
            }

            Mail::to($student->parent_email)
                ->send(new ImmediateIncidentEmail($student, $incidents, $latestIncident));

            Log::info("Critical incident email sent to {$student->parent_email} for student {$student->id}");

        } catch (\Exception $e) {
            Log::error("Failed to send critical incident email for student {$student->id}: " . $e->getMessage());
        }
    }

    /**
     * Send disciplinary hearing email (9 incidents)
     */
    private function sendDisciplinaryHearingEmail(Student $student, $incidents, Incident $latestIncident): void
    {
        try {
            if (empty($student->parent_email)) {
                Log::warning("Cannot send disciplinary hearing email: No parent email for student {$student->id}");
                return;
            }

            Mail::to($student->parent_email)
                ->send(new DisciplinaryHearingEmail($student, $incidents, $latestIncident));

            Log::info("Disciplinary hearing email sent to {$student->parent_email} for student {$student->id}");

        } catch (\Exception $e) {
            Log::error("Failed to send disciplinary hearing email for student {$student->id}: " . $e->getMessage());
        }
    }

    /**
     * Get escalation status for a student
     */
    public function getEscalationStatus(Student $student): array
    {
        $totalIncidents = $student->incidents()->count();
        
        return [
            'total_incidents' => $totalIncidents,
            'warning_sent' => $totalIncidents >= 3,
            'escalation_sent' => $totalIncidents >= 6,
            'hearing_required' => $totalIncidents >= 9,
            'next_threshold' => $this->getNextThreshold($totalIncidents),
        ];
    }

    /**
     * Get the next escalation threshold
     */
    private function getNextThreshold(int $currentIncidents): ?int
    {
        if ($currentIncidents < 3) return 3;
        if ($currentIncidents < 6) return 6;
        if ($currentIncidents < 9) return 9;
        return null; // No more thresholds
    }
} 