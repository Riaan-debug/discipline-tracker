@php
use App\Services\BrandingService;
$branding = BrandingService::getSettings();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urgent Incident Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #dc3545;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #dc3545;
            margin-bottom: 10px;
        }
        .urgent-badge {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .incident-details {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 20px;
            margin: 20px 0;
        }
        .severity-critical {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .severity-major {
            background-color: #fff3cd;
            border-color: #ffeaa7;
            color: #856404;
        }
        .action-required {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 5px;
            padding: 20px;
            margin: 20px 0;
        }
        .contact-info {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 20px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 10px 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">
                <!-- Clean, professional text-based header -->
                <div style="font-size: 32px; font-weight: bold; color: #dc3545; margin-bottom: 15px; text-align: center;">
                    {{ $branding['school_name'] ?? 'Discipline Tracker' }}
                </div>
                <div style="font-size: 16px; color: #666; text-align: center; margin-bottom: 20px;">
                    Learning. Growing. Shining.
                </div>
            </div>
            <div class="urgent-badge">
                URGENT INCIDENT REPORT
            </div>
        </div>

        <p><strong>Dear Parent/Guardian of {{ $student->full_name }},</strong></p>

        <p>This is an <strong>URGENT NOTIFICATION</strong> regarding a serious incident involving your child that occurred today at {{ $branding['school_name'] ?? 'Willow Tree Academy' }}.</p>

        <div class="incident-details severity-{{ $latestIncident->severity }}">
            <h3>📋 Incident Details:</h3>
            <p><strong>Date & Time:</strong> {{ $latestIncident->created_at->format('F j, Y \a\t g:i A') }}</p>
            <p><strong>Incident Type:</strong> {{ $latestIncident->incidentType->name }}</p>
            <p><strong>Severity Level:</strong> <span style="font-weight: bold; text-transform: uppercase;">{{ $latestIncident->severity }}</span></p>
            <p><strong>Reported By:</strong> {{ $latestIncident->reportedBy->name ?? 'School Staff' }}</p>
            <p><strong>Description:</strong></p>
            <p style="background-color: white; padding: 15px; border-radius: 5px; border-left: 4px solid #dc3545;">{{ $latestIncident->description }}</p>
        </div>

        <div class="action-required">
            <h3>⚠️ IMMEDIATE ACTION REQUIRED:</h3>
            <ul>
                <li><strong>Contact the school immediately</strong> - Please call us within the next 2 hours</li>
                <li><strong>Parent meeting required</strong> - We need to discuss this incident with you</li>
                <li><strong>Review with your child</strong> - Please discuss this incident with your child</li>
                <li><strong>Follow-up plan</strong> - We will develop a plan to prevent future incidents</li>
            </ul>
        </div>

        <div class="contact-info">
            <h3>📞 URGENT CONTACT INFORMATION:</h3>
            @if(isset($branding['school_phone']) && $branding['school_phone'])
                <p><strong>School Phone:</strong> {{ $branding['school_phone'] }}</p>
            @endif
            @if(isset($branding['school_email']) && $branding['school_email'])
                <p><strong>Email:</strong> {{ $branding['school_email'] }}</p>
            @endif
            @if(isset($branding['school_address']) && $branding['school_address'])
                <p><strong>Address:</strong> {{ $branding['school_address'] }}</p>
            @endif
            <p><strong>Office Hours:</strong> 7:30 AM - 4:00 PM (Emergency contact available 24/7)</p>
        </div>

        <p><strong>This incident has been documented in your child's disciplinary record.</strong> We take all incidents seriously and are committed to working with you to ensure your child's safety and the safety of others.</p>

        <p style="text-align: center;">
            <a href="tel:5551234567" class="btn">📞 CALL NOW</a>
            <a href="mailto:administration@willowtreeacademy.com" class="btn">📧 EMAIL US</a>
        </p>

        <p><strong>We expect to hear from you within the next 2 hours.</strong></p>

        <p>Sincerely,<br>
        <strong>{{ $branding['school_name'] ?? 'School Administration' }}</strong></p>
    </div>

    <div class="footer">
        <p>This is an automated urgent notification from the {{ $branding['school_name'] ?? 'Discipline Tracker' }} System.</p>
        <p>If you have any questions, please contact the school immediately.</p>
    </div>
</body>
</html> 