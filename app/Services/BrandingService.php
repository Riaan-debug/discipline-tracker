<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class BrandingService
{
    public static function getSettings()
    {
        return Cache::remember('branding_settings', 3600, function () {
            $settingsFile = storage_path('app/branding_settings.json');
            
            if (file_exists($settingsFile)) {
                $settings = json_decode(file_get_contents($settingsFile), true);
                
                // Add default email customization settings if not present
                if (!isset($settings['email_customization'])) {
                    $settings['email_customization'] = [
                        'show_school_motto' => true,
                        'show_contact_info' => true,
                        'show_school_address' => true,
                        'custom_footer_message' => '',
                        'email_header_color' => '#dc3545',
                        'email_accent_color' => '#2c5496',
                        'email_font_family' => 'Arial, sans-serif',
                        'email_signature' => '',
                        'show_urgency_badges' => true,
                        'show_incident_details' => true,
                        'show_action_required' => true,
                        'custom_greeting' => '',
                        'custom_closing' => '',
                    ];
                }
                
                return $settings;
            }

            return [
                'school_name' => 'Discipline Tracker',
                'school_address' => '',
                'school_phone' => '',
                'school_email' => '',
                'primary_color' => '#3b82f6',
                'secondary_color' => '#1e40af',
                'accent_color' => '#10b981',
                'logo_path' => null,
                'favicon_path' => null,
                'updated_at' => null,
                'updated_by' => null,
                'email_customization' => [
                    'show_school_motto' => true,
                    'show_contact_info' => true,
                    'show_school_address' => true,
                    'custom_footer_message' => '',
                    'email_header_color' => '#dc3545',
                    'email_accent_color' => '#2c5496',
                    'email_font_family' => 'Arial, sans-serif',
                    'email_signature' => '',
                    'show_urgency_badges' => true,
                    'show_incident_details' => true,
                    'show_action_required' => true,
                    'custom_greeting' => '',
                    'custom_closing' => '',
                ],
            ];
        });
    }

    public static function getSchoolName()
    {
        $settings = self::getSettings();
        return $settings['school_name'] ?? 'Discipline Tracker';
    }

    public static function getPrimaryColor()
    {
        $settings = self::getSettings();
        return $settings['primary_color'] ?? '#3b82f6';
    }

    public static function getSecondaryColor()
    {
        $settings = self::getSettings();
        return $settings['secondary_color'] ?? '#1e40af';
    }

    public static function getAccentColor()
    {
        $settings = self::getSettings();
        return $settings['accent_color'] ?? '#10b981';
    }

    public static function getLogoUrl()
    {
        $settings = self::getSettings();
        if ($settings['logo_path'] && Storage::disk('public')->exists($settings['logo_path'])) {
            return Storage::disk('public')->url($settings['logo_path']);
        }
        return null;
    }

    public static function getFaviconUrl()
    {
        $settings = self::getSettings();
        if ($settings['favicon_path'] && Storage::disk('public')->exists($settings['favicon_path'])) {
            return Storage::disk('public')->url($settings['favicon_path']);
        }
        return null;
    }

    public static function getSchoolInfo()
    {
        $settings = self::getSettings();
        return [
            'name' => $settings['school_name'] ?? 'Discipline Tracker',
            'address' => $settings['school_address'] ?? '',
            'phone' => $settings['school_phone'] ?? '',
            'email' => $settings['school_email'] ?? '',
        ];
    }

    public static function getColorScheme()
    {
        $settings = self::getSettings();
        return [
            'primary' => $settings['primary_color'] ?? '#3b82f6',
            'secondary' => $settings['secondary_color'] ?? '#1e40af',
            'accent' => $settings['accent_color'] ?? '#10b981',
        ];
    }

    /**
     * Get email customization settings
     */
    public static function getEmailCustomization()
    {
        $settings = self::getSettings();
        return $settings['email_customization'] ?? [
            'show_school_motto' => true,
            'show_contact_info' => true,
            'show_school_address' => true,
            'custom_footer_message' => '',
            'email_header_color' => '#dc3545',
            'email_accent_color' => '#2c5496',
            'email_font_family' => 'Arial, sans-serif',
            'email_signature' => '',
            'show_urgency_badges' => true,
            'show_incident_details' => true,
            'show_action_required' => true,
            'custom_greeting' => '',
            'custom_closing' => '',
        ];
    }

    /**
     * Get specific email customization setting
     */
    public static function getEmailSetting($key, $default = null)
    {
        $customization = self::getEmailCustomization();
        return $customization[$key] ?? $default;
    }

    /**
     * Get logo URL from public/logos folder
     */
    public static function getPublicLogoUrl(): ?string
    {
        // Look for the new logo file
        $logoPath = public_path('logos/Outlook-gvnkeonm.png');
        
        if (file_exists($logoPath)) {
            // Use asset helper for proper URL generation
            return asset('logos/Outlook-gvnkeonm.png');
        }
        
        // Also check for the original logo file
        $logoPath = public_path('logos/Willow Tree Academy Logo PNG (no edge).png');
        if (file_exists($logoPath)) {
            return asset('logos/Willow Tree Academy Logo PNG (no edge).png');
        }
        
        // Check for other common formats
        $formats = ['jpg', 'jpeg', 'gif', 'svg'];
        foreach ($formats as $format) {
            $logoPath = public_path("logos/Willow Tree Academy Logo PNG (no edge).{$format}");
            if (file_exists($logoPath)) {
                return asset("logos/Willow Tree Academy Logo PNG (no edge).{$format}");
            }
        }
        
        // Fallback to generic school-logo filename
        $logoPath = public_path('logos/school-logo.png');
        if (file_exists($logoPath)) {
            return asset('logos/school-logo.png');
        }
        
        return null;
    }

    /**
     * Get logo as base64 data URL for email embedding
     */
    public static function getLogoAsBase64(): ?string
    {
        $settings = self::getSettings();
        
        if (!isset($settings['logo_path']) || !$settings['logo_path']) {
            return null;
        }
        
        $logoPath = storage_path('app/public/' . $settings['logo_path']);
        
        if (!file_exists($logoPath)) {
            return null;
        }
        
        // Get image info
        $imageInfo = getimagesizefromstring(file_get_contents($logoPath));
        
        if (!$imageInfo) {
            return null;
        }
        
        // Create a smaller version for email (max 200x200px)
        $maxWidth = 200;
        $maxHeight = 200;
        
        $width = $imageInfo[0];
        $height = $imageInfo[1];
        
        // Calculate new dimensions
        if ($width > $maxWidth || $height > $maxHeight) {
            $ratio = min($maxWidth / $width, $maxHeight / $height);
            $newWidth = round($width * $ratio);
            $newHeight = round($height * $ratio);
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }
        
        // Create image resource
        $mimeType = $imageInfo['mime'];
        $sourceImage = null;
        
        switch ($mimeType) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($logoPath);
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($logoPath);
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($logoPath);
                break;
            default:
                return null;
        }
        
        if (!$sourceImage) {
            return null;
        }
        
        // Create new image
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preserve transparency for PNG
        if ($mimeType === 'image/png') {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
            imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
        }
        
        // Resize image
        imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        // Output to buffer
        ob_start();
        switch ($mimeType) {
            case 'image/jpeg':
                imagejpeg($newImage, null, 85);
                break;
            case 'image/png':
                imagepng($newImage, null, 6);
                break;
            case 'image/gif':
                imagegif($newImage);
                break;
        }
        $imageData = ob_get_clean();
        
        // Clean up
        imagedestroy($sourceImage);
        imagedestroy($newImage);
        
        $base64 = base64_encode($imageData);
        
        return "data:{$mimeType};base64,{$base64}";
    }
} 