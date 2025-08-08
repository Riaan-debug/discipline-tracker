<?php

namespace App\Mail;

use App\Models\Student;
use App\Services\BrandingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class MonthlySummaryEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Student $student;
    public Collection $incidents;
    public Collection $positiveReports;
    public ?array $gradeStats;
    public string $monthYear;
    public array $branding;

    /**
     * Create a new message instance.
     */
    public function __construct(
        Student $student,
        Collection $incidents,
        Collection $positiveReports,
        ?array $gradeStats = null,
        string $monthYear = null
    ) {
        $this->student = $student;
        $this->incidents = $incidents;
        $this->positiveReports = $positiveReports;
        $this->gradeStats = $gradeStats;
        $this->monthYear = $monthYear ?? now()->format('F Y');
        $this->branding = BrandingService::getSettings();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $schoolName = $this->branding['school_name'] ?? 'Discipline Tracker';
        return new Envelope(
            subject: "Monthly Student Report - {$this->student->full_name} - {$this->monthYear} - {$schoolName}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.monthly-summary',
            with: [
                'student' => $this->student,
                'incidents' => $this->incidents,
                'positiveReports' => $this->positiveReports,
                'gradeStats' => $this->gradeStats,
                'monthYear' => $this->monthYear,
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
