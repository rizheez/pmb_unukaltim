<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::with(['studentBiodata', 'registration.registrationPeriod'])
            ->where('role', 'student')
            ->whereHas('registration')
            ->count();
        $totalAnnouncements = Announcement::count();

        return view('admin.dashboard', [
            'totalStudents' => $totalStudents,
            'totalAnnouncements' => $totalAnnouncements,
        ]);
    }
}
