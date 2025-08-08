<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Incidents Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111827; }
        .header { text-align: center; margin-bottom: 16px; }
        .title { font-size: 20px; font-weight: bold; }
        .meta { font-size: 12px; color: #6b7280; }
        .section { margin-top: 16px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #e5e7eb; padding: 6px 8px; text-align: left; }
        th { background: #f3f4f6; }
        .badge { display: inline-block; padding: 2px 6px; border-radius: 4px; font-size: 11px; }
        .sev-critical { background: #fee2e2; color: #991b1b; }
        .sev-major { background: #ffedd5; color: #9a3412; }
        .sev-moderate { background: #fef3c7; color: #92400e; }
        .sev-minor { background: #e5e7eb; color: #374151; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Incidents Report</div>
        <div class="meta">Generated: {{ $generated_at->format('Y-m-d H:i') }} | Total: {{ $total_count }}</div>
    </div>

    @if(!empty($filters))
        <div class="section">
            <strong>Filters:</strong>
            <div class="meta">{{ json_encode($filters) }}</div>
        </div>
    @endif

    <div class="section">
        <h2 style="font-size:14px; margin:0 0 8px;">Statistics</h2>
        <table>
            <tr>
                <th>Total</th>
                <td>{{ $statistics['total_incidents'] }}</td>
                <th>Open</th>
                <td>{{ $statistics['open_incidents'] }}</td>
                <th>Resolved</th>
                <td>{{ $statistics['resolved_incidents'] }}</td>
                <th>Escalated</th>
                <td>{{ $statistics['escalated_incidents'] }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2 style="font-size:14px; margin:0 0 8px;">Incidents</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Student</th>
                    <th>Type</th>
                    <th>Severity</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Reported By</th>
                </tr>
            </thead>
            <tbody>
                @forelse($incidents as $incident)
                    <tr>
                        <td>{{ $incident->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $incident->student->full_name }}</td>
                        <td>{{ $incident->incidentType->name }}</td>
                        <td>
                            @php $sevClass = match($incident->severity){'critical'=>'sev-critical','major'=>'sev-major','moderate'=>'sev-moderate',default=>'sev-minor'}; @endphp
                            <span class="badge {{ $sevClass }}">{{ ucfirst($incident->severity) }}</span>
                        </td>
                        <td>{{ ucfirst($incident->status) }}</td>
                        <td>{{ $incident->description }}</td>
                        <td>{{ $incident->reportedBy->name ?? 'Unknown' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7">No incidents found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>


