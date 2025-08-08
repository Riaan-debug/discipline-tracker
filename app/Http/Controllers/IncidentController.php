<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Student;
use App\Models\IncidentType;
use App\Services\EmailNotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $incidents = Incident::with(['student', 'incidentType', 'reportedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('incidents.index', compact('incidents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $students = Student::active()->orderBy('last_name')->get();
        $incidentTypes = IncidentType::active()->orderBy('name')->get();
        
        // Pre-select student if coming from student profile
        $selectedStudentId = $request->get('student_id');

        return view('incidents.create', compact('students', 'incidentTypes', 'selectedStudentId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'incident_type_id' => 'required|exists:incident_types,id',
            'description' => 'required|string|min:10',
            'teacher_notes' => 'nullable|string',
            'severity' => 'required|in:minor,moderate,major,critical',
        ]);

        // NEGATIVE SPACE: This should NEVER happen if our business logic is correct
        if (empty(trim($validated['description']))) {
            $this->crash("Attempted to create incident with empty description. "
                         . "StudentId: {$validated['student_id']}, TypeId: {$validated['incident_type_id']}");
        }

        $incident = Incident::create([
            ...$validated,
            'reported_by' => auth()->id() ?? 1, // Default to user ID 1 if no auth
            'status' => 'open',
        ]);

        // Check for email escalation
        $emailService = new EmailNotificationService();
        $emailService->checkForEscalation($incident);

        \App\Services\AuditService::logDataModification('created', 'Incident', $incident->id, [
            'student_id' => $incident->student_id,
            'incident_type_id' => $incident->incident_type_id,
            'severity' => $incident->severity,
        ]);

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Incident reported successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Incident $incident): View
    {
        $incident->load(['student', 'incidentType', 'reportedBy']);

        return view('incidents.show', compact('incident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incident $incident): View
    {
        $students = Student::active()->orderBy('last_name')->get();
        $incidentTypes = IncidentType::active()->orderBy('name')->get();

        return view('incidents.edit', compact('incident', 'students', 'incidentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incident $incident): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'incident_type_id' => 'required|exists:incident_types,id',
            'description' => 'required|string|min:10',
            'teacher_notes' => 'nullable|string',
            'severity' => 'required|in:minor,moderate,major,critical',
            'status' => 'required|in:open,resolved,escalated',
        ]);

        // Append new notes to existing notes if provided
        if (!empty($validated['teacher_notes'])) {
            $existingNotes = $incident->teacher_notes;
            $newNotes = $validated['teacher_notes'];
            
            if (!empty($existingNotes)) {
                $validated['teacher_notes'] = $existingNotes . "\n\n--- " . now()->format('M j, Y g:i A') . " ---\n" . $newNotes;
            } else {
                $validated['teacher_notes'] = $newNotes;
            }
        }

        $incident->update($validated);

        \App\Services\AuditService::logDataModification('updated', 'Incident', $incident->id, [
            'status' => $incident->status,
            'severity' => $incident->severity,
        ]);

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Incident updated successfully.');
    }

    /**
     * Add notes to an incident
     */
    public function addNotes(Request $request, Incident $incident): RedirectResponse
    {
        $validated = $request->validate([
            'additional_notes' => 'required|string|min:5',
        ]);

        $existingNotes = $incident->teacher_notes;
        $newNotes = $validated['additional_notes'];
        
        if (!empty($existingNotes)) {
            $incident->update([
                'teacher_notes' => $existingNotes . "\n\n--- " . now()->format('M j, Y g:i A') . " ---\n" . $newNotes
            ]);
        } else {
            $incident->update([
                'teacher_notes' => $newNotes
            ]);
        }

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Notes added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incident $incident): RedirectResponse
    {
        // NEGATIVE SPACE: This should NEVER happen if our business logic is correct
        if ($incident->status === 'escalated') {
            $this->crash("Attempted to delete escalated incident. "
                         . "IncidentId: {$incident->id}, Status: {$incident->status}");
        }

        $incidentId = $incident->id;
        $incident->delete();
        \App\Services\AuditService::logDataModification('deleted', 'Incident', $incidentId);

        return redirect()->route('incidents.index')
            ->with('success', 'Incident deleted successfully.');
    }

    /**
     * Resolve an incident
     */
    public function resolve(Incident $incident): RedirectResponse
    {
        $user = auth()->user();
        
        // Only principals and admins can resolve incidents
        if (!in_array($user->role, ['admin', 'principal'])) {
            abort(403, 'You do not have permission to resolve incidents.');
        }

        $incident->resolve();
        \App\Services\AuditService::logDataModification('resolved', 'Incident', $incident->id);

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Incident resolved successfully.');
    }

    /**
     * Escalate an incident
     */
    public function escalate(Incident $incident): RedirectResponse
    {
        $user = auth()->user();
        
        // Check if user can escalate incidents
        if (!$user->canEscalateIncidents()) {
            abort(403, 'You do not have permission to escalate incidents.');
        }

        $incident->escalate();
        \App\Services\AuditService::logDataModification('escalated', 'Incident', $incident->id);

        return redirect()->route('incidents.show', $incident)
            ->with('success', 'Incident escalated successfully.');
    }



    /**
     * Negative space programming helper
     */
    private function crash(string $message): never
    {
        $errorData = [
            'timestamp' => now()->toISOString(),
            'message' => $message,
            'request_url' => request()->fullUrl(),
            'user_id' => auth()->id() ?? 'unauthenticated',
        ];
        
        \Log::critical('INVARIANT VIOLATION', $errorData);
        
        throw new \Exception("INVARIANT VIOLATED: {$message}");
    }
}
