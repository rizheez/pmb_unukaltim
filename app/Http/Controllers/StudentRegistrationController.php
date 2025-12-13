<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\RegistrationPeriod;
use App\Models\RegistrationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentRegistrationController extends Controller
{
    public function index()
    {
        $biodata = \App\Models\StudentBiodata::where('user_id', Auth::id())->first();

        if (!$biodata) {
            return redirect()->route('student.biodata.index')->with('error', 'Silakan lengkapi biodata terlebih dahulu sebelum mendaftar.');
        }

        // Check if there's an active registration period
        $activePeriod = RegistrationPeriod::active()->first();
        
        if (!$activePeriod) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Tidak ada periode pendaftaran yang aktif saat ini.');
        }

        $registration = Registration::where('user_id', Auth::id())->first();
        $registrationTypes = RegistrationType::active()->get();
        
        // Get active program studi grouped by fakultas
        $fakultas = \App\Models\Fakultas::active()
            ->with(['programStudi' => function($query) {
                $query->active()->orderBy('jenjang')->orderBy('name');
            }])
            ->orderBy('name')
            ->get();
        
        // Also get flat list for non-grouped dropdown
        $programStudi = \App\Models\ProgramStudi::with('fakultas')
            ->active()
            ->orderBy('jenjang')
            ->orderBy('name')
            ->get();
        
        return view('student.pendaftaran.index', compact('registration', 'activePeriod', 'registrationTypes', 'fakultas', 'programStudi'));
    }

    public function store(Request $request)
    {
        // Check if there's an active period
        $activePeriod = RegistrationPeriod::active()->first();
        
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Tidak ada periode pendaftaran yang aktif saat ini.');
        }

        $request->validate([
            'registration_type_id' => 'required|exists:registration_types,id',
            'choice_1' => 'required|exists:program_studi,id',
            'choice_2' => 'nullable|exists:program_studi,id|different:choice_1',
            'choice_3' => 'nullable|exists:program_studi,id|different:choice_1,choice_2',
        ]);

        Registration::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'registration_type_id' => $request->registration_type_id,
                'choice_1' => $request->choice_1,
                'choice_2' => $request->choice_2,
                'choice_3' => $request->choice_3,
                'status' => 'submitted',
                'registration_period_id' => $activePeriod->id,
            ]
        );

        return redirect()->route('student.pendaftaran.index')->with('success', 'Pendaftaran berhasil dikirim!');
    }
}
