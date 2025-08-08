<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #3B82F6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1F2937;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            color: #6B7280;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .stats-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .stat-box {
            background: #F3F4F6;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            min-width: 120px;
            margin-bottom: 10px;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #3B82F6;
            margin: 0;
        }
        .stat-label {
            font-size: 12px;
            color: #6B7280;
            margin: 5px 0 0 0;
        }
        .filters {
            background: #FEF3C7;
            border: 1px solid #F59E0B;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 30px;
        }
        .filters h3 {
            margin: 0 0 10px 0;
            color: #92400E;
            font-size: 16px;
        }
        .filters p {
            margin: 5px 0;
            font-size: 14px;
            color: #92400E;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background: #3B82F6;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
        }
        td {
            padding: 10px 8px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background: #F9FAFB;
        }
        .status-active {
            color: #059669;
            font-weight: bold;
        }
        .status-inactive {
            color: #DC2626;
            font-weight: bold;
        }
        .incident-count {
            text-align: center;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #E5E7EB;
            text-align: center;
            font-size: 12px;
            color: #6B7280;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Students Report</h1>
        <p>Generated on {{ $generated_at->format('F j, Y \a\t g:i A') }}</p>
        <p>Total Students: {{ $total_count }}</p>
    </div>

    @if(!empty($filters))
        <div class="filters">
            <h3>Applied Filters:</h3>
            @if(isset($filters['q']) && $filters['q'])
                <p><strong>Search:</strong> "{{ $filters['q'] }}"</p>
            @endif
            @if(isset($filters['grade']) && $filters['grade'] !== 'all')
                <p><strong>Grade:</strong> {{ $filters['grade'] }}</p>
            @endif
            @if(isset($filters['status']) && $filters['status'] !== 'all')
                <p><strong>Status:</strong> {{ ucfirst($filters['status']) }}</p>
            @endif
            @if(isset($filters['has_incidents']) && $filters['has_incidents'] !== 'all')
                <p><strong>Incident Status:</strong> {{ ucfirst(str_replace('_', ' ', $filters['has_incidents'])) }}</p>
            @endif
        </div>
    @endif

    <div class="stats-grid">
        <div class="stat-box">
            <p class="stat-number">{{ $statistics['total_students'] }}</p>
            <p class="stat-label">Total Students</p>
        </div>
        <div class="stat-box">
            <p class="stat-number">{{ $statistics['active_students'] }}</p>
            <p class="stat-label">Active Students</p>
        </div>
        <div class="stat-box">
            <p class="stat-number">{{ $statistics['students_with_incidents'] }}</p>
            <p class="stat-label">With Incidents</p>
        </div>
        <div class="stat-box">
            <p class="stat-number">{{ $statistics['total_incidents'] }}</p>
            <p class="stat-label">Total Incidents</p>
        </div>
        <div class="stat-box">
            <p class="stat-number">{{ $statistics['active_incidents'] }}</p>
            <p class="stat-label">Active Incidents</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Grade</th>
                <th>Email</th>
                <th>Parent</th>
                <th>Status</th>
                <th>Incidents</th>
                <th>Active</th>
                <th>Member Since</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td><strong>{{ $student->full_name }}</strong></td>
                    <td>{{ $student->grade }}</td>
                    <td>{{ $student->email ?: 'N/A' }}</td>
                    <td>{{ $student->parent_name }}</td>
                    <td class="{{ $student->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $student->is_active ? 'Active' : 'Inactive' }}
                    </td>
                    <td class="incident-count">{{ $student->incidents()->count() }}</td>
                    <td class="incident-count">{{ $student->incidents()->where('status', 'open')->count() }}</td>
                    <td>{{ $student->created_at->format('M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($statistics['grade_distribution']->count() > 0)
        <div class="page-break">
            <h2>Grade Distribution</h2>
            <table>
                <thead>
                    <tr>
                        <th>Grade</th>
                        <th>Student Count</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statistics['grade_distribution'] as $grade => $count)
                        <tr>
                            <td><strong>{{ $grade }}</strong></td>
                            <td class="incident-count">{{ $count }}</td>
                            <td class="incident-count">{{ round(($count / $statistics['total_students']) * 100, 1) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="footer">
        <p>Discipline Tracker - Professional Student Management System</p>
        <p>Report generated automatically on {{ $generated_at->format('F j, Y \a\t g:i:s A') }}</p>
    </div>
</body>
</html> 