<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get fakultas by code for easy reference
        $feb = \App\Models\Fakultas::where('code', 'FEB')->first();
        $ft = \App\Models\Fakultas::where('code', 'FT')->first();
        $fiskep = \App\Models\Fakultas::where('code', 'FISKEP')->first();
        $ff = \App\Models\Fakultas::where('code', 'FF')->first();

        $programStudi = [
            // FEB
            [
                'fakultas_id' => $feb->id,
                'name' => 'Akuntansi',
                'code' => 'AKT',
                'jenjang' => 'S1',
                'description' => 'Program Studi Akuntansi',
                'quota' => 100,
                'is_active' => true,
            ],
            // FT
            [
                'fakultas_id' => $ft->id,
                'name' => 'Teknik Informatika',
                'code' => 'TI',
                'jenjang' => 'S1',
                'description' => 'Program Studi Teknik Informatika',
                'quota' => 120,
                'is_active' => true,
            ],
            [
                'fakultas_id' => $ft->id,
                'name' => 'Teknik Industri',
                'code' => 'TIN',
                'jenjang' => 'S1',
                'description' => 'Program Studi Teknik Industri',
                'quota' => 200,
                'is_active' => true,
            ],
            [
                'fakultas_id' => $ft->id,
                'name' => 'Arsitektur',
                'code' => 'ARS',
                'jenjang' => 'S1',
                'description' => 'Program Studi Arsitektur',
                'quota' => 60,
                'is_active' => true,
            ],
            [
                'fakultas_id' => $ft->id,
                'name' => 'Desain Interior',
                'code' => 'DI',
                'jenjang' => 'S1',
                'description' => 'Program Studi Desain Interior',
                'quota' => 50,
                'is_active' => true,
            ],
            // fiskep
            [
                'fakultas_id' => $fiskep->id,
                'name' => 'Hubungan Internasional',
                'code' => 'HI',
                'jenjang' => 'S1',
                'description' => 'Program Studi Hubungan Internasional',
                'quota' => 70,
                'is_active' => true,
            ],
            [
                'fakultas_id' => $fiskep->id,
                'name' => 'Ilmu Komunikasi',
                'code' => 'IKOM',
                'jenjang' => 'S1',
                'description' => 'Program Studi Ilmu Komunikasi',
                'quota' => 90,
                'is_active' => true,
            ],
            // FAPERTA
            [
                'fakultas_id' => $ft->id,
                'name' => 'Teknologi Industri Pertanian',
                'code' => 'TIP',
                'jenjang' => 'S1',
                'description' => 'Program Studi Teknologi Industri Pertanian',
                'quota' => 60,
                'is_active' => true,
            ],
            // FKIP
            [
                'fakultas_id' => $fiskep->id,
                'name' => 'Pendidikan Anak Usia Dini',
                'code' => 'PAUD',
                'jenjang' => 'S1',
                'description' => 'Program Studi Pendidikan Anak Usia Dini',
                'quota' => 80,
                'is_active' => true,
            ],
            // FF
            [
                'fakultas_id' => $ff->id,
                'name' => 'Farmasi',
                'code' => 'FAR',
                'jenjang' => 'S1',
                'description' => 'Program Studi Farmasi',
                'quota' => 70,
                'is_active' => true,
            ],
        ];

        foreach ($programStudi as $ps) {
            \App\Models\ProgramStudi::create($ps);
        }
    }
}
