<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed fakultas and program studi first
        $this->call([
            FakultasSeeder::class,
            ProgramStudiSeeder::class,
            LandingPageSettingSeeder::class,
            RegistrationPathSeeder::class,
            RegistrationTypeSeeder::class,
            AdminUserSeeder::class,
        ]);

        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
