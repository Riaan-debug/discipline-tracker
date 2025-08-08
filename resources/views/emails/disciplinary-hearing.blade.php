@php
use App\Services\BrandingService;
$branding = BrandingService::getSettings();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DISCIPLINARY HEARING NOTICE</title>
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
        .school-logo {
            max-width: 160px;
            max-height: 60px;
            display: inline-block;
            margin-bottom: 10px;
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
        .hearing-notice {
            background-color: #f8d7da;
            border: 2px solid #dc3545;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            color: #721c24;
            text-align: center;
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
        .severity-critical {
            color: #dc3545;
            font-weight: bold;
        }
        .severity-major {
            color: #e74c3c;
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
        .legal-notice {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
        }
        .hearing-details {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 20px;
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
            <div class="hearing-notice">
                <h2>🚨 DISCIPLINARY HEARING NOTICE 🚨</h2>
                <p><strong>OFFICIAL NOTIFICATION</strong></p>
            </div>
            
            <p>Dear {{ $student->parent_name }},</p>
            
            <p>This letter serves as <strong>formal notice</strong> that a <strong>Disciplinary Hearing</strong> has been scheduled for <strong>{{ $student->full_name }}</strong> (Grade {{ $student->grade }}) due to the accumulation of <strong>{{ $incidents->count() }} behavioral incidents</strong> at Willow Tree Academy.</p>

            <div class="hearing-details">
                <h3>📅 HEARING DETAILS:</h3>
                <p><strong>Date:</strong> [TO BE SCHEDULED]</p>
                <p><strong>Time:</strong> [TO BE SCHEDULED]</p>
                <p><strong>Location:</strong> Willow Tree Academy - Administration Building</p>
                <p><strong>Duration:</strong> Approximately 60 minutes</p>
            </div>

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

            <h3>Complete Incident History ({{ $incidents->count() }} incidents):</h3>
            <div class="incident-list">
                @foreach($incidents->take(8) as $incident)
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

            <h3>⚠️ POTENTIAL CONSEQUENCES:</h3>
            <ul>
                <li><strong>Suspension:</strong> Temporary removal from school (1-10 days)</li>
                <li><strong>Probation:</strong> Behavioral monitoring period</li>
                <li><strong>Behavioral Contract:</strong> Formal agreement with specific conditions</li>
                <li><strong>Alternative Education:</strong> Modified learning environment</li>
                <li><strong>Expulsion:</strong> Permanent removal from school (in extreme cases)</li>
            </ul>

            <h3>📋 PARENT RIGHTS & RESPONSIBILITIES:</h3>
            <ul>
                <li><strong>Right to Attend:</strong> You have the right to be present at the hearing</li>
                <li><strong>Right to Representation:</strong> You may bring legal counsel or advocate</li>
                <li><strong>Right to Evidence:</strong> You may review all incident reports</li>
                <li><strong>Right to Appeal:</strong> You may appeal the hearing decision</li>
                <li><strong>Responsibility:</strong> You must ensure your child's attendance at the hearing</li>
            </ul>

            <div class="legal-notice">
                <strong>LEGAL NOTICE:</strong><br>
                This hearing is conducted in accordance with Willow Tree Academy's disciplinary policies and procedures. 
                Failure to attend may result in a decision being made in your absence. 
                All decisions are subject to appeal within 10 business days.
            </div>

            <h3>📞 IMMEDIATE ACTION REQUIRED:</h3>
            <ol>
                <li><strong>Contact the school within 24 hours</strong> to confirm receipt of this notice</li>
                <li><strong>Schedule the hearing</strong> at your earliest convenience</li>
                <li><strong>Prepare for the hearing</strong> by reviewing all incident reports</li>
                <li><strong>Consider legal representation</strong> if you believe it necessary</li>
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

            <p>This matter requires your immediate attention. We are committed to working with you to address these serious behavioral concerns while ensuring the safety and well-being of all students.</p>
            
            <p>Sincerely,<br>
            <strong>{{ $branding['school_name'] ?? 'School Disciplinary Committee' }}</strong><br>
            <em>cc: School Principal, Vice Principal, Disciplinary Coordinator</em></p>
        </div>

        <div class="footer">
            <p>This is an automated notification from the {{ $branding['school_name'] ?? 'Discipline Tracker' }} System.</p>
            <p>To update your email preferences, please contact the school office.</p>
        </div>
    </div>
</body>
</html> 