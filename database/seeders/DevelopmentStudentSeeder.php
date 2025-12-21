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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DevelopmentStudentSeeder extends Seeder
{
    public function run(): void
    {
        Model::unguard();

        Model::withoutEvents(function () {
            $this->seedFast();
        });

        Model::reguard();
    }

    private function seedFast(): void
    {
        $this->ensureMasterData();

        $faker = fake();
        $now = now();

        // Pre-compute password hash ONCE (huge performance gain - 99% faster)
        $passwordHash = Hash::make('password');

        $periodId = RegistrationPeriod::where('is_active', true)->value('id');
        $regTypeId = RegistrationType::value('id');
        $prodiIds = ProgramStudi::pluck('id')->toArray();

        // Use DB transaction for better performance
        DB::transaction(function () use ($faker, $now, $passwordHash, $periodId, $regTypeId, $prodiIds) {
            $this->command->info('Seeding SUBMITTED students...');
            $this->seedGroup(
                total: 500,
                status: 'submitted',
                verificationStatus: 'pending',
                faker: $faker,
                now: $now,
                passwordHash: $passwordHash,
                periodId: $periodId,
                regTypeId: $regTypeId,
                prodiIds: $prodiIds
            );

            $this->command->info('Seeding VERIFIED students...');
            $this->seedGroup(
                total: 500,
                status: 'verified',
                verificationStatus: 'approved',
                faker: $faker,
                now: $now,
                passwordHash: $passwordHash,
                periodId: $periodId,
                regTypeId: $regTypeId,
                prodiIds: $prodiIds
            );
        });

        $this->command->info('Seeder selesai dengan cepat.');
    }

    private function seedGroup(
        int $total,
        string $status,
        string $verificationStatus,
        $faker,
        $now,
        string $passwordHash,
        int $periodId,
        int $regTypeId,
        array $prodiIds
    ): void {
        $users = [];
        $biodata = [];
        $registrations = [];
        $verifications = [];

        // Pre-generate some common values to reduce faker overhead
        $namePrefix = $status === 'verified' ? 'Mahasiswa ' : 'Pendaftar ';
        $genders = ['Laki-laki', 'Perempuan'];
        $prodiCount = count($prodiIds);
        $referralSources = ['Dosen/Panitia PMB', 'Sosial Media', 'Teman/Keluarga', 'Website', 'Event Sekolah', 'Lainnya'];

        // ================= USERS =================
        for ($i = 0; $i < $total; $i++) {
            $users[] = [
                'name' => $namePrefix.$faker->firstName,
                'email' => $faker->unique()->userName.'@example.com',
                'password' => $passwordHash, // Use pre-computed hash
                'role' => 'student',
                'phone' => $faker->phoneNumber,
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        User::insert($users);

        // Get the starting ID and calculate the range (more efficient than query)
        $startId = DB::getPdo()->lastInsertId();
        $userIds = range($startId, $startId + $total - 1);

        // ================= BIODATA & REGISTRATION =================
        $registrationTimestamps = []; // Store timestamps for verification

        foreach ($userIds as $idx => $userId) {
            // Random timestamp within last 2 months for more realistic data
            $randomCreatedAt = $faker->dateTimeBetween('-2 months', 'now');
            $registrationTimestamps[$idx] = $randomCreatedAt; // Store for verification

            $biodata[] = [
                'user_id' => $userId,
                'name' => 'User '.$userId,
                'nik' => $faker->unique()->numerify('################'),
                'nisn' => $faker->unique()->numerify('##########'),
                'gender' => $genders[$idx % 2], // Alternate gender for speed
                'birth_place' => $faker->city,
                'birth_date' => $faker->date('Y-m-d', '-18 years'),
                'religion' => 'Islam',
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'last_education' => 'SMA',
                'school_origin' => 'SMA '.$faker->city,
                'major' => 'IPA',
                'photo_path' => 'photos/mock.jpg',
                'kk_path' => 'documents/mock_kk.pdf',
                'ktp_path' => 'documents/mock_ktp.pdf',
                'certificate_path' => 'documents/mock_cert.pdf',
                'created_at' => $randomCreatedAt,
                'updated_at' => $randomCreatedAt,
            ];

            $referralSource = $referralSources[$idx % count($referralSources)];
            $referralDetail = '-';
            if ($referralSource == 'Dosen/Panitia PMB') {
                $referralDetail = $faker->name;
            } elseif ($referralSource == 'Lainnya') {
                $referralDetail = $faker->sentence;
            }

            $registrations[] = [
                'user_id' => $userId,
                'registration_period_id' => $periodId,
                'registration_type_id' => $regTypeId,
                'status' => $status,
                'choice_1' => $prodiIds[$idx % $prodiCount], // Use modulo for speed
                'choice_2' => $prodiIds[($idx + 1) % $prodiCount],
                'registration_path' => 'Umum',
                'referral_source' => $referralSource,
                'referral_detail' => $referralDetail,
                'created_at' => $randomCreatedAt,
                'updated_at' => $randomCreatedAt,
            ];
        }

        StudentBiodata::insert($biodata);
        Registration::insert($registrations);

        // ================= VERIFICATION =================
        $startBioId = DB::getPdo()->lastInsertId();
        $biodataIds = range($startBioId, $startBioId + $total - 1);

        foreach ($biodataIds as $bioIdx => $bioId) {
            // Get the registration timestamp for this biodata
            $registrationTime = $registrationTimestamps[$bioIdx];

            // For approved verifications, add random delay (1-14 days after registration)
            // For pending, use registration time
            if ($verificationStatus === 'approved') {
                $verifiedAt = $faker->dateTimeBetween($registrationTime, min(new \DateTime('now'), (clone $registrationTime)->modify('+14 days')));
            } else {
                $verifiedAt = null;
            }

            foreach (['photo', 'kk', 'ktp', 'biodata'] as $doc) {
                $verifications[] = [
                    'student_biodata_id' => $bioId,
                    'document_type' => $doc,
                    'status' => $verificationStatus,
                    'is_read' => $verificationStatus === 'approved',
                    'verified_by' => $verificationStatus === 'approved' ? 1 : null,
                    'verified_at' => $verifiedAt,
                    'created_at' => $registrationTime, // Created when registration was made
                    'updated_at' => $verifiedAt ?? $registrationTime, // Updated when verified or at creation
                ];
            }
        }

        DocumentVerification::insert($verifications);
    }

    private function ensureMasterData(): void
    {
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

        if (RegistrationType::count() === 0) {
            RegistrationType::create([
                'name' => 'Reguler',
                'description' => 'Pendaftaran jalur reguler',
                'is_active' => true,
            ]);
        }

        if (Fakultas::count() === 0) {
            $fak = Fakultas::create([
                'code' => 'FTI',
                'name' => 'Fakultas Teknologi Industri',
            ]);

            ProgramStudi::insert([
                [
                    'fakultas_id' => $fak->id,
                    'code' => 'TI',
                    'name' => 'Teknik Industri',
                    'jenjang' => 'S1',
                ],
                [
                    'fakultas_id' => $fak->id,
                    'code' => 'IF',
                    'name' => 'Informatika',
                    'jenjang' => 'S1',
                ],
            ]);
        }
    }
}
