<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageSettingController extends Controller
{
    public function edit()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman pengaturan landing page!');
        }
        $settings = LandingPageSetting::getAllGrouped();
        return view('admin.landing-page.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman pengaturan landing page!');
        }
        // Validate all inputs
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'hero_button_text' => 'required|string|max:50',
            'hero_button_url' => 'required|string|max:255',
            'hero_background_image' => 'nullable|image|max:2048',
            
            'feature_1_title' => 'required|string|max:255',
            'feature_1_description' => 'required|string',
            'feature_1_icon' => 'required|string|max:50',
            
            'feature_2_title' => 'required|string|max:255',
            'feature_2_description' => 'required|string',
            'feature_2_icon' => 'required|string|max:50',
            
            'feature_3_title' => 'required|string|max:255',
            'feature_3_description' => 'required|string',
            'feature_3_icon' => 'required|string|max:50',
            
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'about_image' => 'nullable|image|max:2048',
            
            'contact_address' => 'required|string',
            'contact_email' => 'required|email',
            
            'contact_phone_1' => 'required|string|max:20',
            'contact_phone_1_label' => 'required|string|max:100',
            'contact_phone_2' => 'nullable|string|max:20',
            'contact_phone_2_label' => 'nullable|string|max:100',
            'contact_phone_3' => 'nullable|string|max:20',
            'contact_phone_3_label' => 'nullable|string|max:100',
            
            'university_logo' => 'nullable|image|max:2048',
            
            'social_media_facebook' => 'nullable|url|max:255',
            'social_media_instagram' => 'nullable|url|max:255',
            'social_media_website' => 'nullable|url|max:255',
        ]);




        // Get all settings
        $allSettings = LandingPageSetting::all()->keyBy('key');

        // Update text fields
        foreach ($request->except(['_token', '_method', 'hero_background_image', 'about_image', 'university_logo']) as $key => $value) {
            if ($allSettings->has($key)) {
                $setting = $allSettings->get($key);
                $setting->update(['value' => $value]);
            }
        }

        // Handle hero background image upload
        if ($request->hasFile('hero_background_image')) {
            $setting = $allSettings->get('hero_background_image');
            
            // Delete old image if exists
            if ($setting && $setting->value) {
                Storage::disk('public')->delete($setting->value);
            }
            
            $path = $request->file('hero_background_image')->store('landing-page', 'public');
            
            if ($setting) {
                $setting->update(['value' => $path]);
            } else {
                LandingPageSetting::create([
                    'key' => 'hero_background_image',
                    'value' => $path,
                    'type' => 'image',
                    'group' => 'hero',
                ]);
            }
        }

        // Handle about image upload
        if ($request->hasFile('about_image')) {
            $setting = $allSettings->get('about_image');
            
            // Delete old image if exists
            if ($setting && $setting->value) {
                Storage::disk('public')->delete($setting->value);
            }
            
            $path = $request->file('about_image')->store('landing-page', 'public');
            
            if ($setting) {
                $setting->update(['value' => $path]);
            } else {
                LandingPageSetting::create([
                    'key' => 'about_image',
                    'value' => $path,
                    'type' => 'image',
                    'group' => 'about',
                ]);
            }
        }

        // Handle university logo upload
        if ($request->hasFile('university_logo')) {
            $setting = $allSettings->get('university_logo');
            
            // Delete old image if exists
            if ($setting && $setting->value) {
                Storage::disk('public')->delete($setting->value);
            }
            
            $path = $request->file('university_logo')->store('landing-page', 'public');
            
            if ($setting) {
                $setting->update(['value' => $path]);
            } else {
                LandingPageSetting::create([
                    'key' => 'university_logo',
                    'value' => $path,
                    'type' => 'image',
                    'group' => 'contact',
                ]);
            }
        }

        return redirect()->route('admin.landing-page.edit')
            ->with('success', 'Landing page berhasil diupdate!');
    }
}
