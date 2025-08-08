@php
use App\Services\BrandingService;
$branding = BrandingService::getSettings();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Behavior Update</title>
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
        .email-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
        }
        .logo-placeholder {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
        }
        .school-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .motto {
            font-size: 14px;
            color: #7f8c8d;
            font-style: italic;
        }
        .content {
            margin-bottom: 30px;
        }
        .incident-list {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .incident-item {
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .incident-item:last-child {
            border-bottom: none;
        }
        .incident-date {
            font-weight: bold;
            color: #2c3e50;
        }
        .incident-type {
            color: #e74c3c;
            font-weight: 500;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
            color: #7f8c8d;
            font-size: 14px;
        }
        .contact-info {
            background-color: #ecf0f1;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .warning-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
                        <div class="header">
                    <!-- Clean, professional text-based header -->
                    <div style="font-size: 24px; font-weight: bold; color: #dc3545; margin-bottom: 10px; text-align: center;">
                        {{ $branding['school_name'] ?? 'Discipline Tracker' }}
                    </div>
                    <div style="font-size: 14px; color: #666; text-align: center; margin-bottom: 15px;">
                        Learning. Growing. Shining.
                    </div>
        </div>

        <div class="content">
            <h2>Student Behavior Update</h2>
            
            <p>Dear {{ $student->parent_name }},</p>
            
            <p>We wanted to inform you that <strong>{{ $student->full_name }}</strong> (Grade {{ $student->grade }}) has had <strong>{{ $incidents->count() }} behavioral incidents</strong> this semester.</p>
            
            <div class="warning-box">
                <strong>⚠️ Early Communication</strong><br>
                While these incidents are not serious, we believe early communication helps prevent escalation and supports your child's growth.
            </div>

            <h3>Recent Incident Details:</h3>
            <div class="incident-list">
                <div class="incident-item">
                    <div class="incident-date">{{ $latestIncident->created_at->format('M j, Y') }}</div>
                    <div class="incident-type">{{ $latestIncident->incidentType->name }}</div>
                    <div>{{ $latestIncident->description }}</div>
                    <small>Reported by: {{ $latestIncident->reportedBy->name ?? 'Unknown' }}</small>
                </div>
            </div>

            <h3>Previous Incidents:</h3>
            <div class="incident-list">
                @foreach($incidents->take(2) as $incident)
                    @if($incident->id !== $latestIncident->id)
                        <div class="incident-item">
                            <div class="incident-date">{{ $incident->created_at->format('M j, Y') }}</div>
                            <div class="incident-type">{{ $incident->incidentType->name }}</div>
                            <div>{{ $incident->description }}</div>
                        </div>
                    @endif
                @endforeach
            </div>

            <h3>Recommended Actions:</h3>
            <ul>
                <li>Discuss this incident with your child in a calm, supportive manner</li>
                <li>Review classroom expectations and behavioral guidelines</li>
                <li>Encourage open communication about school experiences</li>
                <li>Monitor homework completion and attendance</li>
            </ul>

            <div class="contact-info">
                <strong>Contact Information:</strong><br>
                If you have questions or would like to discuss this further, please contact:<br>
                @if(isset($branding['school_phone']) && $branding['school_phone'])
                    <strong>School Phone:</strong> {{ $branding['school_phone'] }}<br>
                @endif
                @if(isset($branding['school_email']) && $branding['school_email'])
                    <strong>Email:</strong> {{ $branding['school_email'] }}<br>
                @endif
                @if(isset($branding['school_address']) && $branding['school_address'])
                    <strong>Address:</strong> {{ $branding['school_address'] }}
                @endif
            </div>

            <p>We appreciate your partnership in supporting your child's educational journey.</p>
            
            <p>Best regards,<br>
            <strong>{{ $branding['school_name'] ?? 'School Staff' }}</strong></p>
        </div>

        <div class="footer">
            <p>This is an automated notification from the {{ $branding['school_name'] ?? 'Discipline Tracker' }} System.</p>
            <p>To update your email preferences, please contact the school office.</p>
        </div>
    </div>
</body>
</html> 