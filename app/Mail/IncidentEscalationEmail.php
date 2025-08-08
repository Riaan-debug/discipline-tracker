<?php

namespace App\Mail;

use App\Models\Student;
use App\Models\Incident;
use App\Services\BrandingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IncidentEscalationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $student;
    public $incidents;
    public $latestIncident;
    public $branding;

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student, $incidents, Incident $latestIncident)
    {
        $this->student = $student;
        $this->incidents = $incidents;
        $this->latestIncident = $latestIncident;
        $this->branding = BrandingService::getSettings();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $schoolName = $this->branding['school_name'] ?? 'Discipline Tracker';
        return new Envelope(
            subject: 'URGENT: Behavioral Escalation - ' . $this->student->full_name . ' - ' . $schoolName,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.incident-escalation',
            with: [
                'student' => $this->student,
                'incidents' => $this->incidents,
                'latestIncident' => $this->latestIncident,
                'branding' => $this->branding,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 