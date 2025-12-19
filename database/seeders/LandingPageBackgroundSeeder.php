<?php

namespace Database\Seeders;

use App\Models\LandingPageSetting;
use Illuminate\Database\Seeder;

class LandingPageBackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create settings for desktop and mobile background images
        $settings = [
            [
                'key' => 'hero_background_image_desktop',
                'value' => null,
                'type' => 'image',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_background_image_mobile',
                'value' => null,
                'type' => 'image',
                'group' => 'hero',
            ],
        ];

        foreach ($settings as $setting) {
            LandingPageSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
