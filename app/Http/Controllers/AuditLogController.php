<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display a listing of audit logs
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->latest();

        // Filter by event category
        if ($request->filled('category')) {
            $query->where('event_category', $request->category);
        }

        // Filter by event type
        if ($request->filled('type')) {
            $query->where('event_type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by user
        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%')
                  ->orWhere('email', 'like', '%' . $request->user . '%');
            });
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search in description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $logs = $query->paginate(50);

        // Get statistics
        $stats = [
            'total' => AuditLog::count(),
            'authentication' => AuditLog::authentication()->count(),
            'security' => AuditLog::security()->count(),
            'data_access' => AuditLog::dataAccess()->count(),
            'failed' => AuditLog::failed()->count(),
            'successful' => AuditLog::successful()->count(),
        ];

        return view('audit-logs.index', compact('logs', 'stats'));
    }

    /**
     * Display the specified audit log
     */
    public function show(AuditLog $auditLog)
    {
        return view('audit-logs.show', compact('auditLog'));
    }

    /**
     * Export audit logs
     */
    public function export(Request $request)
    {
        $query = AuditLog::with('user')->latest();

        // Apply same filters as index
        if ($request->filled('category')) {
            $query->where('event_category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('event_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->get();

        // Log the export
        \App\Services\AuditService::logDataExport('audit_logs', 'csv', [
            'filters' => $request->all(),
            'record_count' => $logs->count(),
        ]);

        $filename = 'audit_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($logs) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID', 'User', 'Email', 'Event Type', 'Category', 'Description', 
                'Status', 'IP Address', 'Created At'
            ]);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->user_name,
                    $log->user_email,
                    $log->event_type,
                    $log->event_category,
                    $log->description,
                    $log->status,
                    $log->ip_address,
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
