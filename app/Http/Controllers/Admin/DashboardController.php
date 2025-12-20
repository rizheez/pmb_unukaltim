<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\DocumentVerification;
use App\Models\ProgramStudi;
use App\Models\Registration;
use App\Models\RegistrationPeriod;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get active period
        $activePeriod = RegistrationPeriod::where('is_active', true)->first();

        // Total statistics
        $totalStudents = User::where('role', 'student')
            ->whereHas('registration')
            ->count();

        $totalAnnouncements = Announcement::count();

        // Registration by status
        $statusStats = Registration::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $totalDraft = $statusStats['draft'] ?? 0;
        $totalSubmitted = $statusStats['submitted'] ?? 0;
        $totalVerified = $statusStats['verified'] ?? 0;
        $totalAccepted = $statusStats['accepted'] ?? 0;
        $totalRejected = $statusStats['rejected'] ?? 0;

        // Registration by program (top 5)
        $programStats = Registration::select('choice_1', DB::raw('count(*) as total'))
            ->with('programStudiChoice1')
            ->groupBy('choice_1')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Pending verifications
        $pendingVerifications = DocumentVerification::where('status', 'pending')
            ->count();

        // Recent registrations (last 7 days)
        $recentRegistrations = Registration::with(['user.studentBiodata', 'programStudiChoice1'])
            ->where('created_at', '>=', now()->subDays(7))
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Today's registrations
        $todayRegistrations = Registration::whereDate('created_at', today())->count();

        // This week's registrations
        $weekRegistrations = Registration::where('created_at', '>=', now()->startOfWeek())->count();

        // Registration trend (last 7 days)
        $registrationTrend = Registration::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
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
        ]);
    }
}
