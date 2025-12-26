<?php

namespace App\Console\Commands;

use App\Models\Registration;
use App\Models\RegistrationPeriod;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RegenerateRegistrationNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrations:regenerate-numbers
                            {--period= : Specific period ID to regenerate}
                            {--format= : Custom format pattern (default: YYYYWWSSSSS)}
                            {--dry-run : Preview changes without saving}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate ALL registration numbers (overwrites existing). Use when format changes.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->warn('⚠️  WARNING: This will OVERWRITE all existing registration numbers!');

        if (!$this->option('dry-run') && !$this->confirm('Are you sure you want to continue?')) {
            $this->info('Operation cancelled.');
            return 0;
        }

        $periodId = $this->option('period');
        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->info('🔍 DRY RUN MODE - No changes will be saved');
            $this->newLine();
        }

        // Get periods to process
        $query = RegistrationPeriod::whereHas('registrations');
        if ($periodId) {
            $query->where('id', $periodId);
        }
        $periods = $query->get();

        if ($periods->isEmpty()) {
            $this->warn('No registration periods with registrations found.');
            return 0;
        }

        $totalUpdated = 0;
        $previewData = [];

        foreach ($periods as $period) {
            $this->info("Processing period: {$period->name} ({$period->academic_year})");

            // Get ALL registrations for this period, ordered by created_at
            $registrations = Registration::where('registration_period_id', $period->id)
                ->orderBy('created_at', 'asc')
                ->get();

            if ($registrations->isEmpty()) {
                $this->line('  - No registrations in this period.');
                continue;
            }

            $this->line("  - Found {$registrations->count()} registrations to regenerate...");

            // Parse academic year (2025/2026 -> 2526)
            $years = explode('/', $period->academic_year);
            $academicYear = substr($years[0], -2) . substr($years[1] ?? $years[0], -2);

            // Format wave number (1 -> 01)
            $wave = str_pad($period->wave_number, 2, '0', STR_PAD_LEFT);

            $sequence = 1;

            if (!$isDryRun) {
                DB::beginTransaction();
            }

            try {
                foreach ($registrations as $registration) {
                    $oldNumber = $registration->registration_number;
                    $newNumber = $this->generateNumber($academicYear, $wave, $sequence);

                    if ($isDryRun) {
                        $previewData[] = [
                            'ID' => $registration->id,
                            'Old Number' => $oldNumber ?? '(none)',
                            'New Number' => $newNumber,
                        ];
                    } else {
                        $registration->update(['registration_number' => $newNumber]);
                    }

                    $sequence++;
                    $totalUpdated++;
                }

                if (!$isDryRun) {
                    DB::commit();
                    $this->info("  - Regenerated {$registrations->count()} registration numbers.");
                }
            } catch (\Exception $e) {
                if (!$isDryRun) {
                    DB::rollBack();
                }
                $this->error('  - Error: ' . $e->getMessage());
                return 1;
            }
        }

        $this->newLine();

        if ($isDryRun && !empty($previewData)) {
            $this->table(['ID', 'Old Number', 'New Number'], $previewData);
            $this->newLine();
            $this->info("Preview complete. {$totalUpdated} registrations would be updated.");
            $this->info('Run without --dry-run to apply changes.');
        } else {
            $this->info("✅ Regeneration complete! Total registrations updated: {$totalUpdated}");
        }

        return 0;
    }

    /**
     * Generate registration number based on format.
     *
     * Format: [Academic Year 4 digit][Wave 2 digit][Sequence 5 digit]
     * Example: 2526 01 00001 = 252601000001
     *
     * Modify this method to change the format.
     */
    protected function generateNumber(string $academicYear, string $wave, int $sequence): string
    {
        // ========================================
        // UBAH FORMAT DI SINI JIKA ADA PERUBAHAN
        // ========================================
        return $academicYear . $wave . str_pad($sequence, 5, '0', STR_PAD_LEFT);
    }
}
