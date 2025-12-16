<?php

namespace Database\Seeders;

use App\Models\DocumentVerification;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Registration;
use App\Models\RegistrationPeriod;
use App\Models\RegistrationType;
use App\Models\StudentBiodata;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DevelopmentStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure minimal data exists for relations
        $this->ensureMasterData();

        $period = RegistrationPeriod::where('is_active', true)->first();
        $regType = RegistrationType::first();
        $prodis = ProgramStudi::all();
        
        if ($prodis->isEmpty()) {
            $this->command->error('No Program Studi found. Please seed ProgramStudi first or run database migrations.');
            return;
        }
        $totalPendaftar = 500;
        $totalMahasiswaTerverifikasi = 500;
        
        // 3. Create 'Sudah Terdaftar' (Submitted)
        $this->command->info('Creating Users: Sudah Terdaftar...');
        for ($i = 0; $i < $totalPendaftar; $i++) {
            $user = User::create([
                'name' => 'Pendaftar ' . fake()->firstName,
                'email' => fake()->unique()->userName . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'phone' => fake()->phoneNumber,
                'email_verified_at' => now(),
            ]);

            $biodata = $this->createBiodata($user);
            
            $reg = Registration::create([
                'user_id' => $user->id,
                'registration_period_id' => $period->id,
                'registration_type_id' => $regType->id,
                'status' => 'submitted',
                'choice_1' => $prodis->random()->id,
                'choice_2' => $prodis->random()->id,
                'registration_path' => 'Umum',
                'referral_source' => fake()->randomElement(['Dosen/Panitia PMB', 'Sosial Media', 'Teman/Keluarga', 'Website', 'Event Sekolah','Lainnya']),
            ]);

            if($reg->referral_source == 'Dosen/Panitia PMB') {
                $reg->referral_detail = fake()->name;
            }else if ($reg->referral_source == 'Lainnya') {
                $reg->referral_detail = fake()->sentence;
            }else {
                $reg->referral_detail = '-';
            }

            $reg->save();

            // Create Verifications (Pending)
            $this->createVerifications($biodata, 'pending');
        }

        // 4. Create 'Sudah Terverifikasi' (Verified)
        $this->command->info('Creating Users: Sudah Terverifikasi...');
        for ($i = 0; $i < $totalMahasiswaTerverifikasi; $i++) {
            $user = User::create([
                'name' => 'Mahasiswa ' . fake()->firstName,
                'email' => fake()->unique()->userName . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'phone' => fake()->phoneNumber,
                'email_verified_at' => now(),
            ]);

            $biodata = $this->createBiodata($user);

            $reg = Registration::create([
                'user_id' => $user->id,
                'registration_period_id' => $period->id,
                'registration_type_id' => $regType->id,
                'status' => 'verified',
                'choice_1' => $prodis->random()->id,
                'choice_2' => $prodis->random()->id,
                'registration_path' => 'Umum',
                'referral_source' => fake()->randomElement(['Dosen/Panitia PMB', 'Sosial Media', 'Teman/Keluarga', 'Website', 'Event Sekolah','Lainnya']),
            ]);

            if($reg->referral_source == 'Dosen/Panitia PMB') {
                $reg->referral_detail = fake()->name;
            }else if ($reg->referral_source == 'Lainnya') {
                $reg->referral_detail = fake()->sentence;
            }else {
                $reg->referral_detail = '-';
            }

            $reg->save();

            // Create Verifications (Approved)
            $this->createVerifications($biodata, 'approved');
        }
    }

    private function ensureMasterData()
    {
        // Period
        if (RegistrationPeriod::count() === 0) {
            RegistrationPeriod::create([
                'name' => 'Gelombang 1 2025',
                'wave_number' => 1,
                'academic_year' => '2025/2026',
                'start_date' => now()->subDays(10),
                'end_date' => now()->addDays(20),
                'is_active' => true,
            ]);
        }

        // Type
        if (RegistrationType::count() === 0) {
            RegistrationType::create([
                'name' => 'Reguler',
                'description' => 'Pendaftaran jalur reguler',
                'is_active' => true
            ]);
        }

        // Fakultas & Prodi (Basic mock if empty)
        if (Fakultas::count() === 0) {
            $fak = Fakultas::create(['code' => 'FTId', 'name' => 'Fakultas Teknologi Industri']);
            ProgramStudi::create(['fakultas_id' => $fak->id, 'code' => 'TI', 'name' => 'Teknik Industri', 'jenjang' => 'S1']);
            ProgramStudi::create(['fakultas_id' => $fak->id, 'code' => 'IF', 'name' => 'Informatika', 'jenjang' => 'S1']);
        }
    }

    private function createBiodata(User $user)
    {
        return StudentBiodata::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'nik' => fake()->unique()->numerify('################'),
            'nisn' => fake()->unique()->numerify('##########'),
            'gender' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'birth_place' => fake()->city,
            'birth_date' => fake()->date('Y-m-d', '-18 years'),
            'religion' => 'Islam',
            'phone' => $user->phone,
            'address' => fake()->address,
            'last_education' => 'SMA',
            'school_origin' => 'SMA ' . fake()->city,
            'major' => 'IPA',
            // Mock file paths (they won't exist on disk but DB will have them)
            'photo_path' => 'photos/mock.jpg',
            'kk_path' => 'documents/mock_kk.pdf',
            'ktp_path' => 'documents/mock_ktp.pdf',
            'certificate_path' => 'documents/mock_cert.pdf',
        ]);
    }

    private function createVerifications(StudentBiodata $biodata, $status)
    {
        $docs = ['photo', 'kk', 'ktp', 'biodata'];
        foreach ($docs as $doc) {
            DocumentVerification::create([
                'student_biodata_id' => $biodata->id,
                'document_type' => $doc,
                'status' => $status, // pending or approved
                'is_read' => $status === 'pending' ? false : true,
                'verified_by' => $status === 'approved' ? 1 : null, // Assuming admin ID 1
                'verified_at' => $status === 'approved' ? now() : null,
            ]);
        }
    }
}
