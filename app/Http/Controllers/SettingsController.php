<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index()
    {
        // Check if user has admin or principal role
        if (!auth()->user() || !in_array(auth()->user()->role, ['admin', 'principal'])) {
            abort(403, 'Access denied. Only administrators and principals can access this page.');
        }

        $settings = $this->getSettings();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Check if user has admin or principal role
        if (!auth()->user() || !in_array(auth()->user()->role, ['admin', 'principal'])) {
            abort(403, 'Access denied. Only administrators and principals can access this page.');
        }

        $validator = Validator::make($request->all(), [
            'school_name' => 'required|string|max:255',
            'school_address' => 'nullable|string|max:500',
            'school_phone' => 'nullable|string|max:20',
            'school_email' => 'nullable|email|max:255',
            'primary_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'secondary_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'accent_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:1024',
            // Email customization validation
            'show_school_motto' => 'boolean',
            'show_contact_info' => 'boolean',
            'show_school_address' => 'boolean',
            'custom_footer_message' => 'nullable|string|max:1000',
            'email_header_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'email_accent_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'email_font_family' => 'required|string|max:100',
            'email_signature' => 'nullable|string|max:500',
            'show_urgency_badges' => 'boolean',
            'show_incident_details' => 'boolean',
            'show_action_required' => 'boolean',
            'custom_greeting' => 'nullable|string|max:500',
            'custom_closing' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get current settings to preserve existing logo/favicon paths
        $currentSettings = $this->getSettings();

        $settings = [
            'school_name' => $request->school_name,
            'school_address' => $request->school_address,
            'school_phone' => $request->school_phone,
            'school_email' => $request->school_email,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'accent_color' => $request->accent_color,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
            'email_customization' => [
                'show_school_motto' => $request->boolean('show_school_motto'),
                'show_contact_info' => $request->boolean('show_contact_info'),
                'show_school_address' => $request->boolean('show_school_address'),
                'custom_footer_message' => $request->custom_footer_message,
                'email_header_color' => $request->email_header_color,
                'email_accent_color' => $request->email_accent_color,
                'email_font_family' => $request->email_font_family,
                'email_signature' => $request->email_signature,
                'show_urgency_badges' => $request->boolean('show_urgency_badges'),
                'show_incident_details' => $request->boolean('show_incident_details'),
                'show_action_required' => $request->boolean('show_action_required'),
                'custom_greeting' => $request->custom_greeting,
                'custom_closing' => $request->custom_closing,
            ],
        ];

        // Preserve existing logo/favicon paths if not uploading new ones
        if (isset($currentSettings['logo_path'])) {
            $settings['logo_path'] = $currentSettings['logo_path'];
        }
        if (isset($currentSettings['favicon_path'])) {
            $settings['favicon_path'] = $currentSettings['favicon_path'];
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            try {
                $logoPath = $request->file('logo')->store('branding', 'public');
                $settings['logo_path'] = $logoPath;
            } catch (\Exception $e) {
                return back()->withErrors(['logo' => 'Failed to upload logo: ' . $e->getMessage()])->withInput();
            }
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            try {
                $faviconPath = $request->file('favicon')->store('branding', 'public');
                $settings['favicon_path'] = $faviconPath;
            } catch (\Exception $e) {
                return back()->withErrors(['favicon' => 'Failed to upload favicon: ' . $e->getMessage()])->withInput();
            }
        }

        // Save settings to cache and file
        $this->saveSettings($settings);

        \App\Services\AuditService::logDataModification('updated', 'BrandingSettings', auth()->id() ?? 0, [
            'changed' => array_keys($request->all()),
        ]);

        return redirect()->route('settings.index')
            ->with('success', 'Branding settings updated successfully!');
    }

    public function reset()
    {
        // Check if user has admin or principal role
        if (!auth()->user() || !in_array(auth()->user()->role, ['admin', 'principal'])) {
            abort(403, 'Access denied. Only administrators and principals can access this page.');
        }

        $defaultSettings = [
            'school_name' => 'Discipline Tracker',
            'school_address' => '',
            'school_phone' => '',
            'school_email' => '',
            'primary_color' => '#3b82f6',
            'secondary_color' => '#1e40af',
            'accent_color' => '#10b981',
            'logo_path' => null,
            'favicon_path' => null,
            'updated_at' => now(),
            'updated_by' => auth()->id(),
        ];

        $this->saveSettings($defaultSettings);
        \App\Services\AuditService::logDataModification('reset', 'BrandingSettings', auth()->id() ?? 0);

        return redirect()->route('settings.index')
            ->with('success', 'Branding settings reset to default!');
    }

    private function getSettings()
    {
        return Cache::remember('branding_settings', 3600, function () {
            $settingsFile = storage_path('app/branding_settings.json');
            
            if (file_exists($settingsFile)) {
                return json_decode(file_get_contents($settingsFile), true);
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
            ];
        });
    }

    private function saveSettings($settings)
    {
        $settingsFile = storage_path('app/branding_settings.json');
        file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
        
        Cache::forget('branding_settings');
        Cache::put('branding_settings', $settings, 3600);
    }
} 