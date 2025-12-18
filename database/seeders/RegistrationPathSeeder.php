<?php

namespace Database\Seeders;

use App\Models\RegistrationPath;
use Illuminate\Database\Seeder;

class RegistrationPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paths = [
            [
                'name' => 'Umum',
                'description' => 'Jalur pendaftaran umum untuk calon mahasiswa baru',
                'is_active' => true,
            ],
            [
                'name' => 'Kelas Karyawan',
                'description' => 'Jalur pendaftaran khusus untuk karyawan yang ingin melanjutkan pendidikan',
                'is_active' => true,
            ],
        ];

        foreach ($paths as $path) {
            RegistrationPath::updateOrCreate(
                ['name' => $path['name']],
                $path
            );
        }
    }
}
