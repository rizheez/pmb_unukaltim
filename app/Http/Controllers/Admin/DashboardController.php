<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalAnnouncements = Announcement::count();

        return view('admin.dashboard', [
            'totalStudents' => $totalStudents,
            'totalAnnouncements' => $totalAnnouncements,
        ]);
    }
}
