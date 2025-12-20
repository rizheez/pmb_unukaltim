<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class ReRegistrationController extends Controller
{
    /**
     * Display the re-registration page.
     * Only accessible for students with verified or accepted registration status.
     */
    public function index()
    {
        $user = auth()->user();
        $registration = Registration::where('user_id', $user->id)->first();

        // Check if student has registration and status is verified or accepted
        if (!$registration || !in_array($registration->status, ['verified', 'accepted'])) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Anda belum memenuhi syarat untuk daftar ulang. Status pendaftaran harus sudah terverifikasi.');
        }

        $biodata = $user->studentBiodata;

        return view('student.daftar-ulang.index', [
            'registration' => $registration,
            'biodata' => $biodata,
        ]);
    }
}
