@php
use App\Services\BrandingService;
$branding = BrandingService::getSettings();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Student Report - {{ $student->full_name }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: white;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .student-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #667eea;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #ecf0f1;
        }
        .incident-item {
            background: #fff5f5;
            border-left: 4px solid #e53e3e;
            padding: 12px;
            margin-bottom: 8px;
            border-radius: 4px;
        }
        .positive-item {
            background: #f0fff4;
            border-left: 4px solid #38a169;
            padding: 12px;
            margin-bottom: 8px;
            border-radius: 4px;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 8px;
        }
        .badge-critical { background: #fed7d7; color: #c53030; }
        .badge-major { background: #feebc8; color: #c05621; }
        .badge-moderate { background: #fef5e7; color: #d69e2e; }
        .badge-minor { background: #e2e8f0; color: #4a5568; }
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .stat-label {
            font-size: 12px;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ecf0f1;
            color: #7f8c8d;
            font-size: 12px;
        }
        .no-data {
            text-align: center;
            color: #7f8c8d;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>
<body>
                    <div class="header">
                    <!-- Clean, professional text-based header -->
                    <div style="font-size: 28px; font-weight: bold; color: white; margin-bottom: 10px; text-align: center;">
                        {{ $branding['school_name'] ?? 'Discipline Tracker' }}
                    </div>
                    <div style="font-size: 14px; color: #e0e0e0; text-align: center; margin-bottom: 15px;">
                        Learning. Growing. Shining.
                    </div>
        <h1>📊 Monthly Student Report</h1>
        <p>{{ $monthYear }}</p>
    </div>
    
    <div class="content">
        <div class="student-info">
            <h2>{{ $student->full_name }}</h2>
            <p><strong>Grade:</strong> {{ $student->grade }} | <strong>Parent:</strong> {{ $student->parent_name }}</p>
        </div>

        <!-- Statistics Overview -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $incidents->count() }}</div>
                <div class="stat-label">Total Incidents</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $positiveReports->count() }}</div>
                <div class="stat-label">Positive Reports</div>
            </div>
        </div>

        <!-- Incidents Section -->
        <div class="section">
            <div class="section-title">📋 Behavioral Incidents</div>
            @if($incidents->count() > 0)
                @foreach($incidents as $incident)
                    <div class="incident-item">
                        <strong>{{ $incident->incidentType->name }}</strong>
                        <span class="badge badge-{{ $incident->severity }}">{{ ucfirst($incident->severity) }}</span>
                        <br>
                        <small>{{ $incident->created_at->format('M j, Y') }} - {{ Str::limit($incident->description, 100) }}</small>
                    </div>
                @endforeach
            @else
                <div class="no-data">No incidents reported this month</div>
            @endif
        </div>

        <!-- Positive Reports Section -->
        <div class="section">
            <div class="section-title">🌟 Positive Achievements</div>
            @if($positiveReports->count() > 0)
                @foreach($positiveReports as $report)
                    <div class="positive-item">
                        <strong>{{ $report->positiveReportType->name }}</strong>
                        <br>
                        <small>{{ $report->created_at->format('M j, Y') }} - {{ Str::limit($report->description, 100) }}</small>
                    </div>
                @endforeach
            @else
                <div class="no-data">No positive reports this month</div>
            @endif
        </div>

        <!-- Grade Comparison -->
        @if($gradeStats)
        <div class="section">
            <div class="section-title">📊 Grade Level Comparison</div>
            <p><strong>Grade {{ $student->grade }} Average:</strong> {{ $gradeStats['avg_incidents'] }} incidents per student</p>
            <p><strong>{{ $student->first_name }}'s Position:</strong> {{ $gradeStats['position'] }} out of {{ $gradeStats['total_students'] }} students</p>
        </div>
        @endif

        <div class="footer">
            <p>This report was automatically generated by the {{ $branding['school_name'] ?? 'Discipline Tracker' }} System</p>
            @if(isset($branding['school_phone']) && $branding['school_phone'])
                <p><strong>Phone:</strong> {{ $branding['school_phone'] }}</p>
            @endif
            @if(isset($branding['school_email']) && $branding['school_email'])
                <p><strong>Email:</strong> {{ $branding['school_email'] }}</p>
            @endif
            @if(isset($branding['school_address']) && $branding['school_address'])
                <p><strong>Address:</strong> {{ $branding['school_address'] }}</p>
            @endif
            <p>If you have any questions, please contact the school administration</p>
        </div>
    </div>
</body>
</html> 