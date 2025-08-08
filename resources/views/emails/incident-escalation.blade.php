<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URGENT: Behavioral Concerns</title>
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
        .urgent-box {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            color: #721c24;
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
        .severity-high {
            color: #e74c3c;
            font-weight: bold;
        }
        .severity-moderate {
            color: #f39c12;
            font-weight: bold;
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
        .action-required {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            @php
                $logoUrl = \App\Services\BrandingService::getPublicLogoUrl();
            @endphp
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $branding['school_name'] ?? 'School Logo' }}" style="max-height: 50px; max-width: 150px; display: block; margin: 0 auto 10px auto;">
            @else
                <!-- Fallback text logo -->
                <div style="font-size: 24px; font-weight: bold; color: #dc3545; margin-bottom: 10px; text-align: center;">
                    🌳 {{ $branding['school_name'] ?? 'Discipline Tracker' }}
                </div>
            @endif
            <div class="school-name">{{ $branding['school_name'] ?? 'Discipline Tracker' }}</div>
            <div class="motto">Learning. Growing. Shining.</div>
        </div>

        <div class="content">
            <h2>URGENT: Behavioral Concerns</h2>
            
            <div class="urgent-box">
                <strong>🚨 FORMAL NOTIFICATION</strong><br>
                This is a formal notification that <strong>{{ $student->full_name }}</strong> (Grade {{ $student->grade }}) has accumulated <strong>{{ $incidents->count() }} behavioral incidents</strong>, requiring immediate parental involvement.
            </div>
            
            <p>Dear {{ $student->parent_name }},</p>
            
            <p>We are writing to inform you of a serious concern regarding your child's behavior at Willow Tree Academy. <strong>{{ $student->full_name }}</strong> has now been involved in <strong>{{ $incidents->count() }} behavioral incidents</strong> this semester.</p>

            <h3>Latest Incident Details:</h3>
            <div class="incident-list">
                <div class="incident-item">
                    <div class="incident-date">{{ $latestIncident->created_at->format('M j, Y g:i A') }}</div>
                    <div class="incident-type">{{ $latestIncident->incidentType->name }}</div>
                    <div class="severity-{{ $latestIncident->severity }}">Severity: {{ ucfirst($latestIncident->severity) }}</div>
                    <div>{{ $latestIncident->description }}</div>
                    <small>Reported by: {{ $latestIncident->reportedBy->name ?? 'Unknown' }}</small>
                </div>
            </div>

            <h3>Complete Incident History:</h3>
            <div class="incident-list">
                @foreach($incidents->take(5) as $incident)
                    @if($incident->id !== $latestIncident->id)
                        <div class="incident-item">
                            <div class="incident-date">{{ $incident->created_at->format('M j, Y') }}</div>
                            <div class="incident-type">{{ $incident->incidentType->name }}</div>
                            <div class="severity-{{ $incident->severity }}">Severity: {{ ucfirst($incident->severity) }}</div>
                            <div>{{ $incident->description }}</div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="action-required">
                <h3>⚠️ IMMEDIATE ACTION REQUIRED:</h3>
                <ul>
                    <li><strong>Parent Meeting:</strong> A meeting with school administration is required within 48 hours</li>
                    <li><strong>Behavioral Plan:</strong> A formal behavioral improvement plan will be developed</li>
                    <li><strong>Consequences:</strong> Further incidents may result in suspension or other disciplinary measures</li>
                    <li><strong>Support:</strong> We will work together to support your child's behavioral improvement</li>
                </ul>
            </div>

            <h3>Next Steps:</h3>
            <ol>
                <li><strong>Contact the school immediately</strong> to schedule a meeting</li>
                <li>Review all incidents with your child</li>
                <li>Implement consistent consequences at home</li>
                <li>Monitor your child's behavior closely</li>
                <li>Consider additional support services if needed</li>
            </ol>

            <div class="contact-info">
                <strong>URGENT CONTACT INFORMATION:</strong><br>
                @if(isset($branding['school_phone']) && $branding['school_phone'])
                    <strong>School Phone:</strong> {{ $branding['school_phone'] }}<br>
                @endif
                @if(isset($branding['school_email']) && $branding['school_email'])
                    <strong>Email:</strong> {{ $branding['school_email'] }}<br>
                @endif
                @if(isset($branding['school_address']) && $branding['school_address'])
                    <strong>Address:</strong> {{ $branding['school_address'] }}<br>
                @endif
                <strong>Office Hours:</strong> 7:30 AM - 4:00 PM
            </div>

            <p>We take these matters seriously and are committed to working with you to address these behavioral concerns. Your immediate attention to this matter is required.</p>
            
            <p>Sincerely,<br>
            <strong>{{ $branding['school_name'] ?? 'School Administration' }}</strong></p>
        </div>

        <div class="footer">
            <p>This is an automated notification from the {{ $branding['school_name'] ?? 'Discipline Tracker' }} System.</p>
            <p>To update your email preferences, please contact the school office.</p>
        </div>
    </div>
</body>
</html> 