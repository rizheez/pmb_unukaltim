<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fakultas = [
            [
                'name' => 'Fakultas Ekonomi dan Bisnis',
                'code' => 'FEB',
                'description' => 'Fakultas yang menyelenggarakan pendidikan di bidang ekonomi dan bisnis',
                'is_active' => true,
            ],
            [
                'name' => 'Fakultas Teknik',
                'code' => 'FT',
                'description' => 'Fakultas yang menyelenggarakan pendidikan di bidang teknik dan teknologi',
                'is_active' => true,
            ],
            [
                'name' => 'Fakultas Ilmu Sosial dan Kependidikan',
                'code' => 'FISKEP',
                'description' => 'Fakultas yang menyelenggarakan pendidikan di bidang ilmu sosial dan pendidikan',
                'is_active' => true,
            ],
            [
                'name' => 'Fakultas Farmasi',
                'code' => 'FF',
                'description' => 'Fakultas yang menyelenggarakan pendidikan di bidang farmasi',
                'is_active' => true,
            ],
        ];

        foreach ($fakultas as $fak) {
            \App\Models\Fakultas::create($fak);
        }
    }
}
