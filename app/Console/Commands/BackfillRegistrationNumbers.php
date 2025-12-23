<?php

namespace App\Console\Commands;

use App\Models\Registration;
use App\Models\RegistrationPeriod;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackfillRegistrationNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrations:backfill-numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill registration numbers for existing registrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting backfill of registration numbers...');

        // Get all periods that have registrations
        $periods = RegistrationPeriod::whereHas('registrations')->get();

        if ($periods->isEmpty()) {
            $this->warn('No registration periods with registrations found.');

            return 0;
        }

        $totalUpdated = 0;

        foreach ($periods as $period) {
            $this->info("Processing period: {$period->name} ({$period->academic_year})");

            // Get registrations without number, ordered by created_at
            $registrations = Registration::where('registration_period_id', $period->id)
                ->whereNull('registration_number')
                ->orderBy('created_at', 'asc')
                ->get();

            if ($registrations->isEmpty()) {
                $this->line('  - No registrations need numbers in this period.');

                continue;
            }

            $this->line("  - Found {$registrations->count()} registrations to process...");

            // Parse academic year (2025/2026 -> 2526)
            $years = explode('/', $period->academic_year);
            $academicYear = substr($years[0], -2).substr($years[1] ?? $years[0], -2);

            // Format wave number (1 -> 01)
            $wave = str_pad($period->wave_number, 2, '0', STR_PAD_LEFT);

            // Get last existing sequence for this period
            $lastRegistration = Registration::where('registration_period_id', $period->id)
                ->whereNotNull('registration_number')
                ->orderByRaw('CAST(SUBSTRING(registration_number, -5) AS UNSIGNED) DESC')
                ->first();

            $sequence = $lastRegistration
                ? (int) substr($lastRegistration->registration_number, -5) + 1
                : 1;

            DB::beginTransaction();
            try {
                foreach ($registrations as $registration) {
                    $registrationNumber = $academicYear.$wave.str_pad($sequence, 5, '0', STR_PAD_LEFT);
                    $registration->update(['registration_number' => $registrationNumber]);
                    $sequence++;
                    $totalUpdated++;
                }
                DB::commit();
                $this->info("  - Updated {$registrations->count()} registrations.");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error('  - Error: '.$e->getMessage());

                return 1;
            }
        }

        $this->newLine();
        $this->info("✅ Backfill complete! Total registrations updated: {$totalUpdated}");

        return 0;
    }
}
