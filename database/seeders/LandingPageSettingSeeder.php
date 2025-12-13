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
        [
            'key' => 'hero_title',
            'value' => 'Penerimaan Mahasiswa Baru Universitas Nahdlatul Ulama Kalimantan Timur',
            'type' => 'text',
            'group' => 'hero'
        ],
        [
            'key' => 'hero_subtitle',
            'value' => 'Kuliah Mudah, Terjangkau, dan Berbasis Nilai Keislaman',
            'type' => 'text',
            'group' => 'hero'
        ],
        [
            'key' => 'hero_description',
            'value' => 'Universitas Nahdlatul Ulama Kalimantan Timur membuka Penerimaan Mahasiswa Baru melalui sistem pendaftaran online. Tersedia berbagai jalur masuk serta kesempatan mendapatkan beasiswa dan bantuan biaya pendidikan bagi calon mahasiswa yang memenuhi persyaratan.',
            'type' => 'textarea',
            'group' => 'hero'
        ],
        [
            'key' => 'hero_button_text',
            'value' => 'Daftar Sekarang',
            'type' => 'text',
            'group' => 'hero'
        ],
        [
            'key' => 'hero_button_url',
            'value' => '/login',
            'type' => 'url',
            'group' => 'hero'
        ],
        [
            'key' => 'hero_background_image',
            'value' => null,
            'type' => 'image',
            'group' => 'hero'
        ],

        // Feature 1 (CTA Beasiswa)
        [
            'key' => 'feature_1_title',
            'value' => 'Beasiswa & Bantuan Pendidikan',
            'type' => 'text',
            'group' => 'features'
        ],
        [
            'key' => 'feature_1_description',
            'value' => 'UNU Kaltim menyediakan kesempatan beasiswa dan bantuan biaya pendidikan, termasuk program KIP-Kuliah, GratisPol, dan skema pendukung lainnya, untuk membantu mahasiswa menyelesaikan studi dengan lebih ringan.',
            'type' => 'textarea',
            'group' => 'features'
        ],
        [
            'key' => 'feature_1_icon',
            'value' => 'clipboard-check',
            'type' => 'text',
            'group' => 'features'
        ],

        // Feature 2
        [
            'key' => 'feature_2_title',
            'value' => 'Program Studi',
            'type' => 'text',
            'group' => 'features'
        ],
        [
            'key' => 'feature_2_description',
            'value' => 'Tersedia berbagai program studi pada beberapa fakultas yang dirancang untuk menjawab kebutuhan dunia kerja serta perkembangan ilmu pengetahuan dan teknologi.',
            'type' => 'textarea',
            'group' => 'features'
        ],
        [
            'key' => 'feature_2_icon',
            'value' => 'graduation-cap',
            'type' => 'text',
            'group' => 'features'
        ],

        // Feature 3
        [
            'key' => 'feature_3_title',
            'value' => 'Lingkungan Akademik',
            'type' => 'text',
            'group' => 'features'
        ],
        [
            'key' => 'feature_3_description',
            'value' => 'Lingkungan akademik yang kondusif, islami, dan berlandaskan nilai Ahlussunnah Wal Jamaah untuk mendukung proses pembelajaran dan pengembangan karakter mahasiswa.',
            'type' => 'textarea',
            'group' => 'features'
        ],
        [
            'key' => 'feature_3_icon',
            'value' => 'building-2',
            'type' => 'text',
            'group' => 'features'
        ],

        // About Section
        [
            'key' => 'about_title',
            'value' => 'Tentang Universitas Nahdlatul Ulama Kalimantan Timur',
            'type' => 'text',
            'group' => 'about'
        ],
        [
            'key' => 'about_description',
            'value' => 'Universitas Nahdlatul Ulama Kalimantan Timur (UNU Kaltim) merupakan perguruan tinggi yang berlandaskan nilai Islam Ahlussunnah Wal Jamaah dan kebangsaan. UNU Kaltim menyelenggarakan pendidikan tinggi melalui kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat dengan tujuan menghasilkan lulusan yang berilmu, berakhlak, dan mampu berkontribusi bagi pembangunan daerah serta bangsa. Dengan sistem pembelajaran yang terus dikembangkan dan dukungan fasilitas akademik yang memadai, UNU Kaltim berkomitmen menghadirkan pendidikan tinggi yang inklusif dan terjangkau.',
            'type' => 'textarea',
            'group' => 'about'
        ],
        [
            'key' => 'about_image',
            'value' => null,
            'type' => 'image',
            'group' => 'about'
        ],

        // Contact Section
        [
            'key' => 'contact_address',
            'value' => 'Jl. APT. Pranoto, Kel. Gunung Panjang Kec. Samarinda Seberang',
            'type' => 'text',
            'group' => 'contact'
        ],
        [
            'key' => 'contact_email',
            'value' => 'pmb@unukaltim.ac.id',
            'type' => 'text',
            'group' => 'contact'
        ],
        // Contact Numbers with Labels
        [
            'key' => 'contact_phone_1',
            'value' => '0541-4104842',
            'type' => 'text',
            'group' => 'contact'
        ],
        [
            'key' => 'contact_phone_1_label',
            'value' => 'Admin UNU Kaltim',
            'type' => 'text',
            'group' => 'contact'
        ],
        [
            'key' => 'contact_phone_2',
            'value' => '0812-xxxx-xxxx',
            'type' => 'text',
            'group' => 'contact'
        ],
        [
            'key' => 'contact_phone_2_label',
            'value' => 'Bapak Rudi',
            'type' => 'text',
            'group' => 'contact'
        ],
        [
            'key' => 'contact_phone_3',
            'value' => '',
            'type' => 'text',
            'group' => 'contact'
        ],
        [
            'key' => 'contact_phone_3_label',
            'value' => '',
            'type' => 'text',
            'group' => 'contact'
        ],
        [
            'key' => 'university_logo',
            'value' => null,
            'type' => 'image',
            'group' => 'contact'
        ],

        // Social Media
        [
            'key' => 'social_media_facebook',
            'value' => 'https://facebook.com/unukaltim',
            'type' => 'text',
            'group' => 'social_media'
        ],
        [
            'key' => 'social_media_instagram',
            'value' => 'https://instagram.com/unukaltim',
            'type' => 'text',
            'group' => 'social_media'
        ],
        [
            'key' => 'social_media_website',
            'value' => 'https://unukaltim.ac.id',
            'type' => 'text',
            'group' => 'social_media'
        ],
    ];

    foreach ($settings as $setting) {
    LandingPageSetting::updateOrCreate(
        [
            'key'   => $setting['key'],
            'group' => $setting['group'],
        ],
        [
            'value' => $setting['value'],
            'type'  => $setting['type'],
        ]
    );
}
}


}
