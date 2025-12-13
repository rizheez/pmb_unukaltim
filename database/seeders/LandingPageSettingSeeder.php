<?php

namespace Database\Seeders;

use App\Models\LandingPageSetting;
use Illuminate\Database\Seeder;

class LandingPageSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero Section
            ['key' => 'hero_title', 'value' => 'Selamat Datang di PMB Universitas Nurul Kaltim', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Wujudkan Impian Pendidikan Tinggi Anda', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => 'Bergabunglah dengan ribuan mahasiswa yang telah mempercayakan masa depan mereka bersama kami. Raih kesuksesan dengan pendidikan berkualitas dan fasilitas modern.', 'type' => 'textarea', 'group' => 'hero'],
            ['key' => 'hero_button_text', 'value' => 'Daftar Sekarang', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_button_url', 'value' => '/login', 'type' => 'url', 'group' => 'hero'],
            ['key' => 'hero_background_image', 'value' => null, 'type' => 'image', 'group' => 'hero'],

            // Feature 1
            ['key' => 'feature_1_title', 'value' => 'Pendaftaran Mudah', 'type' => 'text', 'group' => 'features'],
            ['key' => 'feature_1_description', 'value' => 'Proses pendaftaran online yang cepat dan mudah. Daftar kapan saja, di mana saja tanpa perlu datang ke kampus.', 'type' => 'textarea', 'group' => 'features'],
            ['key' => 'feature_1_icon', 'value' => 'clipboard-check', 'type' => 'text', 'group' => 'features'],

            // Feature 2
            ['key' => 'feature_2_title', 'value' => 'Program Studi Berkualitas', 'type' => 'text', 'group' => 'features'],
            ['key' => 'feature_2_description', 'value' => 'Pilihan program studi yang beragam dengan kurikulum terkini dan dosen berpengalaman di bidangnya.', 'type' => 'textarea', 'group' => 'features'],
            ['key' => 'feature_2_icon', 'value' => 'graduation-cap', 'type' => 'text', 'group' => 'features'],

            // Feature 3
            ['key' => 'feature_3_title', 'value' => 'Fasilitas Modern', 'type' => 'text', 'group' => 'features'],
            ['key' => 'feature_3_description', 'value' => 'Kampus dilengkapi dengan laboratorium, perpustakaan digital, dan ruang kelas yang nyaman untuk mendukung pembelajaran.', 'type' => 'textarea', 'group' => 'features'],
            ['key' => 'feature_3_icon', 'value' => 'building-2', 'type' => 'text', 'group' => 'features'],

            // About Section
            ['key' => 'about_title', 'value' => 'Tentang Universitas Nurul Kaltim', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_description', 'value' => 'Universitas Nurul Kaltim adalah institusi pendidikan tinggi yang berkomitmen untuk menghasilkan lulusan berkualitas, berakhlak mulia, dan siap bersaing di era global. Dengan pengalaman puluhan tahun dalam dunia pendidikan, kami terus berinovasi untuk memberikan pendidikan terbaik bagi mahasiswa.', 'type' => 'textarea', 'group' => 'about'],

            // Contact Section
            ['key' => 'contact_address', 'value' => 'Jl. Pendidikan No. 123, Samarinda, Kalimantan Timur', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'pmb@unukaltim.ac.id', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '0541-1234567', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '6281234567890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'university_logo', 'value' => null, 'type' => 'image', 'group' => 'contact'],
        ];

        foreach ($settings as $setting) {
            LandingPageSetting::create($setting);
        }
    }
}
