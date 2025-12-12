<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistrationType;

class RegistrationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Reguler',
                'description' => 'Pendaftaran jalur reguler',
                'is_active' => true,
            ],
            [
                'name' => 'CBT',
                'description' => 'Pendaftaran jalur Computer Based Test',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            RegistrationType::create($type);
        }
    }
}
