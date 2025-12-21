<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Registration;
use App\Models\RegistrationPeriod;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all periods for dropdown
        $allPeriods = RegistrationPeriod::orderByDesc('academic_year')
            ->orderByDesc('wave_number')
            ->get();

        // Get active period
        $activePeriod = RegistrationPeriod::where('is_active', true)->first();

        // Get selected period (from query param or default to active)
        $selectedPeriodId = request('period_id');
        if ($selectedPeriodId) {
            $selectedPeriod = RegistrationPeriod::find($selectedPeriodId);
        } else {
            $selectedPeriod = $activePeriod;
        }

        // Use selected period ID for filtering
        $filterPeriodId = $selectedPeriod?->id;

        // Total statistics (global - all periods)
        $totalStudents = User::where('role', 'student')
            ->whereHas('registration')
            ->count();

        $totalAnnouncements = Announcement::count();

        // Registration by status (filtered by active period)
        $statusStats = Registration::select('status', DB::raw('count(*) as total'))
            ->when($filterPeriodId, fn ($q) => $q->where('registration_period_id', $filterPeriodId))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $totalDraft = $statusStats['draft'] ?? 0;
        $totalSubmitted = $statusStats['submitted'] ?? 0;
        $totalVerified = $statusStats['verified'] ?? 0;
        $totalAccepted = $statusStats['accepted'] ?? 0;
        $totalRejected = $statusStats['rejected'] ?? 0;

        // Registration by program (top 5) - filtered by active period
        $programStats = Registration::select('choice_1', DB::raw('count(*) as total'))
            ->when($filterPeriodId, fn ($q) => $q->where('registration_period_id', $filterPeriodId))
            ->with('programStudiChoice1')
            ->groupBy('choice_1')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Pending verifications (students with 'submitted' status that need verification) - filtered by active period
        $pendingVerifications = Registration::where('status', 'submitted')
            ->when($filterPeriodId, fn ($q) => $q->where('registration_period_id', $filterPeriodId))
            ->count();

        // Recent registrations (last 7 days) - filtered by active period
        $recentRegistrations = Registration::with(['user.studentBiodata', 'programStudiChoice1'])
            ->when($filterPeriodId, fn ($q) => $q->where('registration_period_id', $filterPeriodId))
            ->where('created_at', '>=', now()->subDays(7))
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Today's registrations - filtered by active period
        $todayRegistrations = Registration::whereDate('created_at', today())
            ->when($filterPeriodId, fn ($q) => $q->where('registration_period_id', $filterPeriodId))
            ->count();

        // This week's registrations - filtered by active period
        $weekRegistrations = Registration::where('created_at', '>=', now()->startOfWeek())
            ->when($filterPeriodId, fn ($q) => $q->where('registration_period_id', $filterPeriodId))
            ->count();

        // Registration trend (last 7 days) - filtered by active period
        $registrationTrend = Registration::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
            ->when($filterPeriodId, fn ($q) => $q->where('registration_period_id', $filterPeriodId))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', [
            'totalStudents' => $totalStudents,
            'totalAnnouncements' => $totalAnnouncements,
            'totalDraft' => $totalDraft,
            'totalSubmitted' => $totalSubmitted,
            'totalVerified' => $totalVerified,
            'totalAccepted' => $totalAccepted,
            'totalRejected' => $totalRejected,
            'programStats' => $programStats,
            'pendingVerifications' => $pendingVerifications,
            'recentRegistrations' => $recentRegistrations,
            'todayRegistrations' => $todayRegistrations,
            'weekRegistrations' => $weekRegistrations,
            'registrationTrend' => $registrationTrend,
            'activePeriod' => $activePeriod,
            'allPeriods' => $allPeriods,
            'selectedPeriod' => $selectedPeriod,
        ]);
    }
}
