<?php

namespace App\Http\Controllers;

use App\Models\PositiveReportType;
use App\Services\AuditService;
use Illuminate\Http\Request;

class PositiveReportTypeController extends Controller
{
    public function index()
    {
        $positiveReportTypes = PositiveReportType::orderBy('name')->get();
        return view('positive-report-types.index', compact('positiveReportTypes'));
    }

    public function create()
    {
        return view('positive-report-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:positive_report_types'],
            'description' => ['nullable', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:10'],
            'is_active' => ['boolean'],
        ]);

        // Handle checkbox for is_active
        $validated['is_active'] = $request->has('is_active');

        $positiveReportType = PositiveReportType::create($validated);

        AuditService::logDataModification(
            'created',
            'positive_report_type',
            $positiveReportType->id,
            ["name" => $positiveReportType->name]
        );

        return redirect()->route('positive-report-types.index')
            ->with('success', 'Positive report type created successfully!');
    }

    public function edit(PositiveReportType $positiveReportType)
    {
        return view('positive-report-types.edit', compact('positiveReportType'));
    }

    public function update(Request $request, PositiveReportType $positiveReportType)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:positive_report_types,name,' . $positiveReportType->id],
            'description' => ['nullable', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:10'],
            'is_active' => ['boolean'],
        ]);

        // Handle checkbox for is_active
        $validated['is_active'] = $request->has('is_active');

        $oldName = $positiveReportType->name;
        $positiveReportType->update($validated);

        AuditService::logDataModification(
            'updated',
            'positive_report_type',
            $positiveReportType->id,
            ["old_name" => $oldName, "new_name" => $positiveReportType->name]
        );

        return redirect()->route('positive-report-types.index')
            ->with('success', 'Positive report type updated successfully!');
    }

    public function destroy(PositiveReportType $positiveReportType)
    {
        // Check if positive report type is being used
        if ($positiveReportType->positiveReports()->count() > 0) {
            return back()->with('error', 'Cannot delete positive report type that has associated reports.');
        }

        $name = $positiveReportType->name;
        $positiveReportType->delete();

        AuditService::logDataModification(
            'deleted',
            'positive_report_type',
            0,
            ["deleted_name" => $name]
        );

        return redirect()->route('positive-report-types.index')
            ->with('success', 'Positive report type deleted successfully!');
    }
}
