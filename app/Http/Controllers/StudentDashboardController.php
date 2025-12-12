<?php

namespace App\Http\Controllers;

use App\Models\StudentBiodata;
use App\Models\Registration;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $biodata = StudentBiodata::with('verifications')
            ->where('user_id', Auth::id())
            ->first();
        $registration = Registration::where('user_id', Auth::id())->first();
        
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

        $steps = [
            ['name' => 'Pengisian Biodata', 'completed' => (bool)$biodata, 'active' => !$biodata],
            ['name' => 'Pendaftaran', 'completed' => (bool)$registration, 'active' => $biodata && !$registration],
            // ['name' => 'Pembayaran', 'completed' => false, 'active' => false],
            ['name' => 'Proses Ujian', 'completed' => false, 'active' => false],
            ['name' => 'Registrasi Ulang', 'completed' => false, 'active' => false],
            ['name' => 'Selesai', 'completed' => false, 'active' => false],
        ];

        return view('student.dashboard', compact('biodata', 'registration', 'steps', 'announcements', 'activePeriod', 'rejectedVerifications'));
    }
}
