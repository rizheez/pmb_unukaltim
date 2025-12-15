<?php

namespace Database\Seeders;

use App\Models\RegistrationType;
use Illuminate\Database\Seeder;

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
            RegistrationType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
