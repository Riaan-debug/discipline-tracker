@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Branding Settings</h1>
                    <p class="text-gray-600">Customize your school's branding and appearance</p>
                </div>
                <div class="flex space-x-3">
                    <form method="POST" action="{{ route('settings.reset') }}" class="inline" onsubmit="return confirm('Are you sure you want to reset all branding settings to default?')">
                        @csrf
                        <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                            Reset to Default
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Settings Form -->
        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <!-- School Information -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">School Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="school_name" class="block text-sm font-medium text-gray-700 mb-2">School Name *</label>
                        <input type="text" id="school_name" name="school_name" value="{{ old('school_name', $settings['school_name'] ?? '') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        @error('school_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="school_email" class="block text-sm font-medium text-gray-700 mb-2">School Email</label>
                        <input type="email" id="school_email" name="school_email" value="{{ old('school_email', $settings['school_email'] ?? '') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('school_email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="school_phone" class="block text-sm font-medium text-gray-700 mb-2">School Phone</label>
                        <input type="text" id="school_phone" name="school_phone" value="{{ old('school_phone', $settings['school_phone'] ?? '') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('school_phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="school_address" class="block text-sm font-medium text-gray-700 mb-2">School Address</label>
                        <textarea id="school_address" name="school_address" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('school_address', $settings['school_address'] ?? '') }}</textarea>
                        @error('school_address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Branding Assets -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Branding Assets</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">School Logo</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                            @if(isset($settings['logo_path']) && $settings['logo_path'])
                                <div class="mb-4">
                                    <img src="{{ Storage::disk('public')->url($settings['logo_path']) }}" alt="Current Logo" class="max-h-32 mx-auto">
                                    <p class="text-xs text-gray-500 mt-2">Path: {{ $settings['logo_path'] }}</p>
                                </div>
                            @else
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @endif
                            <div class="mt-4">
                                <input type="file" name="logo" accept="image/*" class="hidden" id="logo-upload">
                                <label for="logo-upload" class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                    {{ isset($settings['logo_path']) && $settings['logo_path'] ? 'Change Logo' : 'Upload Logo' }}
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF, SVG up to 2MB</p>
                        </div>
                        @error('logo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Favicon Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                            @if(isset($settings['favicon_path']) && $settings['favicon_path'])
                                <div class="mb-4">
                                    <img src="{{ Storage::disk('public')->url($settings['favicon_path']) }}" alt="Current Favicon" class="max-h-16 mx-auto">
                                    <p class="text-xs text-gray-500 mt-2">Path: {{ $settings['favicon_path'] }}</p>
                                </div>
                            @else
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @endif
                            <div class="mt-4">
                                <input type="file" name="favicon" accept="image/*" class="hidden" id="favicon-upload">
                                <label for="favicon-upload" class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                    {{ isset($settings['favicon_path']) && $settings['favicon_path'] ? 'Change Favicon' : 'Upload Favicon' }}
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">ICO, PNG, JPG up to 1MB</p>
                        </div>
                        @error('favicon')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Color Scheme -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Color Scheme</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="primary_color" class="block text-sm font-medium text-gray-700 mb-2">Primary Color *</label>
                        <div class="flex items-center space-x-3">
                            <input type="color" id="primary_color" name="primary_color" value="{{ old('primary_color', $settings['primary_color'] ?? '#3b82f6') }}" 
                                   class="w-16 h-12 border border-gray-300 rounded-lg cursor-pointer">
                            <input type="text" value="{{ old('primary_color', $settings['primary_color'] ?? '#3b82f6') }}" 
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   onchange="document.getElementById('primary_color').value = this.value">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Main brand color used throughout the app</p>
                        @error('primary_color')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="secondary_color" class="block text-sm font-medium text-gray-700 mb-2">Secondary Color *</label>
                        <div class="flex items-center space-x-3">
                            <input type="color" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $settings['secondary_color'] ?? '#1e40af') }}" 
                                   class="w-16 h-12 border border-gray-300 rounded-lg cursor-pointer">
                            <input type="text" value="{{ old('secondary_color', $settings['secondary_color'] ?? '#1e40af') }}" 
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   onchange="document.getElementById('secondary_color').value = this.value">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Secondary brand color for accents</p>
                        @error('secondary_color')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="accent_color" class="block text-sm font-medium text-gray-700 mb-2">Accent Color *</label>
                        <div class="flex items-center space-x-3">
                            <input type="color" id="accent_color" name="accent_color" value="{{ old('accent_color', $settings['accent_color'] ?? '#10b981') }}" 
                                   class="w-16 h-12 border border-gray-300 rounded-lg cursor-pointer">
                            <input type="text" value="{{ old('accent_color', $settings['accent_color'] ?? '#10b981') }}" 
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   onchange="document.getElementById('accent_color').value = this.value">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Accent color for highlights and success states</p>
                        @error('accent_color')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Color Preview -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Color Preview</h3>
                    <div class="flex space-x-4">
                        <div class="text-center">
                            <div id="primary-preview" class="w-12 h-12 rounded-lg mb-2" style="background-color: {{ old('primary_color', $settings['primary_color'] ?? '#3b82f6') }}"></div>
                            <span class="text-xs text-gray-600">Primary</span>
                        </div>
                        <div class="text-center">
                            <div id="secondary-preview" class="w-12 h-12 rounded-lg mb-2" style="background-color: {{ old('secondary_color', $settings['secondary_color'] ?? '#1e40af') }}"></div>
                            <span class="text-xs text-gray-600">Secondary</span>
                        </div>
                        <div class="text-center">
                            <div id="accent-preview" class="w-12 h-12 rounded-lg mb-2" style="background-color: {{ old('accent_color', $settings['accent_color'] ?? '#10b981') }}"></div>
                            <span class="text-xs text-gray-600">Accent</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email Customization -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Email Customization</h2>
                
                <div class="space-y-6">
                    <!-- Email Colors -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="email_header_color" class="block text-sm font-medium text-gray-700 mb-2">Email Header Color *</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" id="email_header_color" name="email_header_color" 
                                       value="{{ old('email_header_color', $settings['email_customization']['email_header_color'] ?? '#dc3545') }}" 
                                       class="w-16 h-12 border border-gray-300 rounded-lg cursor-pointer">
                                <input type="text" value="{{ old('email_header_color', $settings['email_customization']['email_header_color'] ?? '#dc3545') }}" 
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                       onchange="document.getElementById('email_header_color').value = this.value">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Color for email headers and titles</p>
                            @error('email_header_color')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email_accent_color" class="block text-sm font-medium text-gray-700 mb-2">Email Accent Color *</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" id="email_accent_color" name="email_accent_color" 
                                       value="{{ old('email_accent_color', $settings['email_customization']['email_accent_color'] ?? '#2c5496') }}" 
                                       class="w-16 h-12 border border-gray-300 rounded-lg cursor-pointer">
                                <input type="text" value="{{ old('email_accent_color', $settings['email_customization']['email_accent_color'] ?? '#2c5496') }}" 
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                       onchange="document.getElementById('email_accent_color').value = this.value">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Color for email accents and highlights</p>
                            @error('email_accent_color')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email_font_family" class="block text-sm font-medium text-gray-700 mb-2">Email Font Family *</label>
                            <select id="email_font_family" name="email_font_family" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="Arial, sans-serif" {{ (old('email_font_family', $settings['email_customization']['email_font_family'] ?? 'Arial, sans-serif') == 'Arial, sans-serif') ? 'selected' : '' }}>Arial</option>
                                <option value="Helvetica, sans-serif" {{ (old('email_font_family', $settings['email_customization']['email_font_family'] ?? 'Arial, sans-serif') == 'Helvetica, sans-serif') ? 'selected' : '' }}>Helvetica</option>
                                <option value="Georgia, serif" {{ (old('email_font_family', $settings['email_customization']['email_font_family'] ?? 'Arial, sans-serif') == 'Georgia, serif') ? 'selected' : '' }}>Georgia</option>
                                <option value="Times New Roman, serif" {{ (old('email_font_family', $settings['email_customization']['email_font_family'] ?? 'Arial, sans-serif') == 'Times New Roman, serif') ? 'selected' : '' }}>Times New Roman</option>
                                <option value="Verdana, sans-serif" {{ (old('email_font_family', $settings['email_customization']['email_font_family'] ?? 'Arial, sans-serif') == 'Verdana, sans-serif') ? 'selected' : '' }}>Verdana</option>
                            </select>
                            @error('email_font_family')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Content Options -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900">Email Content Options</h3>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="show_school_motto" name="show_school_motto" value="1" 
                                       {{ old('show_school_motto', $settings['email_customization']['show_school_motto'] ?? true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_school_motto" class="ml-2 block text-sm text-gray-900">Show School Motto</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="show_contact_info" name="show_contact_info" value="1" 
                                       {{ old('show_contact_info', $settings['email_customization']['show_contact_info'] ?? true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_contact_info" class="ml-2 block text-sm text-gray-900">Show Contact Information</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="show_school_address" name="show_school_address" value="1" 
                                       {{ old('show_school_address', $settings['email_customization']['show_school_address'] ?? true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_school_address" class="ml-2 block text-sm text-gray-900">Show School Address</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="show_urgency_badges" name="show_urgency_badges" value="1" 
                                       {{ old('show_urgency_badges', $settings['email_customization']['show_urgency_badges'] ?? true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_urgency_badges" class="ml-2 block text-sm text-gray-900">Show Urgency Badges</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="show_incident_details" name="show_incident_details" value="1" 
                                       {{ old('show_incident_details', $settings['email_customization']['show_incident_details'] ?? true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_incident_details" class="ml-2 block text-sm text-gray-900">Show Incident Details</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="show_action_required" name="show_action_required" value="1" 
                                       {{ old('show_action_required', $settings['email_customization']['show_action_required'] ?? true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="show_action_required" class="ml-2 block text-sm text-gray-900">Show Action Required Section</label>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900">Custom Messages</h3>
                            
                            <div>
                                <label for="custom_greeting" class="block text-sm font-medium text-gray-700 mb-2">Custom Greeting</label>
                                <input type="text" id="custom_greeting" name="custom_greeting" 
                                       value="{{ old('custom_greeting', $settings['email_customization']['custom_greeting'] ?? '') }}" 
                                       placeholder="e.g., Dear Parent/Guardian"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('custom_greeting')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="custom_closing" class="block text-sm font-medium text-gray-700 mb-2">Custom Closing</label>
                                <input type="text" id="custom_closing" name="custom_closing" 
                                       value="{{ old('custom_closing', $settings['email_customization']['custom_closing'] ?? '') }}" 
                                       placeholder="e.g., Best regards, School Administration"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('custom_closing')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email_signature" class="block text-sm font-medium text-gray-700 mb-2">Email Signature</label>
                                <textarea id="email_signature" name="email_signature" rows="3" 
                                          placeholder="e.g., Principal John Smith&#10;Willow Tree Academy&#10;Phone: (555) 123-4567"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('email_signature', $settings['email_customization']['email_signature'] ?? '') }}</textarea>
                                @error('email_signature')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="custom_footer_message" class="block text-sm font-medium text-gray-700 mb-2">Custom Footer Message</label>
                                <textarea id="custom_footer_message" name="custom_footer_message" rows="3" 
                                          placeholder="e.g., Thank you for your cooperation in maintaining a positive learning environment."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('custom_footer_message', $settings['email_customization']['custom_footer_message'] ?? '') }}</textarea>
                                @error('custom_footer_message')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200">
                    Save Branding Settings
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Update color previews when color inputs change
document.querySelectorAll('input[type="color"]').forEach(input => {
    input.addEventListener('change', function() {
        const previewId = this.id.replace('_color', '-preview');
        const preview = document.getElementById(previewId);
        if (preview) {
            preview.style.backgroundColor = this.value;
        }
    });
});

// Update color inputs when text inputs change
document.querySelectorAll('input[type="text"]').forEach(input => {
    if (input.value.match(/^#[0-9A-F]{6}$/i)) {
        input.addEventListener('change', function() {
            const colorInput = this.previousElementSibling;
            if (colorInput && colorInput.type === 'color') {
                colorInput.value = this.value;
                const previewId = colorInput.id.replace('_color', '-preview');
                const preview = document.getElementById(previewId);
                if (preview) {
                    preview.style.backgroundColor = this.value;
                }
            }
        });
    }
});
</script>
@endsection 