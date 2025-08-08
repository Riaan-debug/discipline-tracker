<?php

namespace App\Http\Controllers;

use App\Models\IncidentType;
use App\Services\AuditService;
use Illuminate\Http\Request;

class IncidentTypeController extends Controller
{
    public function index()
    {
        $incidentTypes = IncidentType::orderBy('name')->get();
        return view('incident-types.index', compact('incidentTypes'));
    }

    public function create()
    {
        return view('incident-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:incident_types'],
            'description' => ['nullable', 'string', 'max:1000'],
            'severity' => ['nullable', 'in:minor,moderate,major,critical'],
            'is_active' => ['boolean'],
        ]);

        // Handle checkbox for is_active
        $validated['is_active'] = $request->has('is_active');

        $incidentType = IncidentType::create($validated);

        AuditService::logDataModification(
            'created',
            'incident_type',
            $incidentType->id,
            ["name" => $incidentType->name]
        );

        return redirect()->route('incident-types.index')
            ->with('success', 'Incident type created successfully!');
    }

    public function edit(IncidentType $incidentType)
    {
        return view('incident-types.edit', compact('incidentType'));
    }

    public function update(Request $request, IncidentType $incidentType)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:incident_types,name,' . $incidentType->id],
            'description' => ['nullable', 'string', 'max:1000'],
            'severity' => ['nullable', 'in:minor,moderate,major,critical'],
            'is_active' => ['boolean'],
        ]);

        // Handle checkbox for is_active
        $validated['is_active'] = $request->has('is_active');

        $oldName = $incidentType->name;
        $incidentType->update($validated);

        AuditService::logDataModification(
            'updated',
            'incident_type',
            $incidentType->id,
            ["old_name" => $oldName, "new_name" => $incidentType->name]
        );

        return redirect()->route('incident-types.index')
            ->with('success', 'Incident type updated successfully!');
    }

    public function destroy(IncidentType $incidentType)
    {
        // Check if incident type is being used
        if ($incidentType->incidents()->count() > 0) {
            return back()->with('error', 'Cannot delete incident type that has associated incidents.');
        }

        $name = $incidentType->name;
        $incidentType->delete();

        AuditService::logDataModification(
            'deleted',
            'incident_type',
            0,
            ["deleted_name" => $name]
        );

        return redirect()->route('incident-types.index')
            ->with('success', 'Incident type deleted successfully!');
    }
}
