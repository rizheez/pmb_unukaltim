<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Registration;
use App\Models\StudentBiodata;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $biodata = StudentBiodata::with('verifications')
            ->where('user_id', Auth::id())
            ->first();
        $registration = Registration::with(['acceptedProgramStudi', 'programStudiChoice1', 'programStudiChoice2', 'registrationType'])
            ->where('user_id', Auth::id())
            ->first();

        // Get published announcements
        $announcements = Announcement::where('is_published', true)
            ->latest()
            ->get();

        // Get active registration period
        $activePeriod = \App\Models\RegistrationPeriod::active()->first();

        // Get unread rejected verifications
        $rejectedVerifications = $biodata
            ? $biodata->verifications()
                ->where('status', 'rejected')
                ->where('is_read', false)
                ->get()
            : collect();

        $isVerified = $registration && in_array($registration->status, ['verified', 'accepted']);
        $isRejected = $registration && $registration->status === 'rejected';
        $isAccepted = $registration && $registration->status === 'accepted';

        $steps = [
            ['name' => 'Registrasi Akun', 'completed' => true, 'active' => false, 'failed' => false],
            ['name' => 'Lengkapi Biodata', 'completed' => (bool) $biodata, 'active' => ! $biodata, 'failed' => false],
            ['name' => 'Pilih Program Studi', 'completed' => (bool) $registration, 'active' => $biodata && ! $registration, 'failed' => false],
            ['name' => 'Verifikasi Data', 'completed' => $isVerified || $isAccepted, 'active' => $registration && ! $isVerified && ! $isRejected, 'failed' => $isRejected],
            ['name' => 'Daftar Ulang', 'completed' => false, 'active' => $isAccepted, 'failed' => false],
            ['name' => 'Selesai', 'completed' => false, 'active' => false, 'failed' => false],
        ];

        return view('student.dashboard', compact('biodata', 'registration', 'steps', 'announcements', 'activePeriod', 'rejectedVerifications'));
    }
}
