<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\RegistrationPath;
use App\Models\RegistrationPeriod;
use App\Models\RegistrationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentRegistrationController extends Controller
{
    public function index()
    {
        $biodata = \App\Models\StudentBiodata::where('user_id', Auth::id())->first();

        if (! $biodata) {
            return redirect()->route('student.biodata.index')->with('error', 'Silakan lengkapi biodata terlebih dahulu sebelum mendaftar.');
        }

        // Check if there's an active registration period
        $activePeriod = RegistrationPeriod::active()->first();

        if (! $activePeriod) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Tidak ada periode pendaftaran yang aktif saat ini.');
        }

        $registration = Registration::where('user_id', Auth::id())->first();
        $registrationTypes = RegistrationType::active()->get();
        $registrationPaths = RegistrationPath::active()->get();

        // Get active program studi grouped by fakultas
        $fakultas = \App\Models\Fakultas::active()
            ->with(['programStudi' => function ($query) {
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

        return view('student.pendaftaran.index', compact('registration', 'activePeriod', 'registrationTypes', 'registrationPaths', 'fakultas', 'programStudi'));
    }

    public function store(Request $request)
    {
        // Check if there's an active period
        $activePeriod = RegistrationPeriod::active()->first();

        if (! $activePeriod) {
            return redirect()->back()->with('error', 'Tidak ada periode pendaftaran yang aktif saat ini.');
        }

        $request->validate([
            'registration_type_id' => 'required|exists:registration_types,id',
            'registration_path_id' => 'required|exists:registration_paths,id',
            'referral_source' => 'nullable|string|max:255',
            'referral_detail' => 'required_if:referral_source,Lainnya,Dosen/Panitia PMB UNU Kaltim|nullable|string|max:255',
            'choice_1' => 'required|exists:program_studi,id',
            'choice_2' => 'required|exists:program_studi,id|different:choice_1',
            'choice_3' => 'nullable|exists:program_studi,id|different:choice_1,choice_2',
        ], [
            'required' => ':attribute wajib diisi.',
            'exists' => ':attribute tidak valid.',
            'in' => ':attribute tidak valid.',
            'different' => 'Program studi :attribute tidak boleh sama.',
            'required_if' => ':attribute wajib diisi jika memilih "Lainnya".',
        ], [
            'registration_type_id' => 'Jenis Pendaftaran',
            'registration_path_id' => 'Jalur Pendaftaran',
            'referral_source' => 'Sumber Informasi',
            'referral_detail' => 'Detail Sumber Informasi',
            'choice_1' => 'Pilihan 1',
            'choice_2' => 'Pilihan 2',
            'choice_3' => 'Pilihan 3',
        ]);

        // Check if user already has a registration
        $existingRegistration = Registration::where('user_id', Auth::id())->first();

        $data = [
            'registration_type_id' => $request->registration_type_id,
            'registration_path_id' => $request->registration_path_id,
            'referral_source' => $request->referral_source,
            'referral_detail' => $request->referral_detail,
            'choice_1' => $request->choice_1,
            'choice_2' => $request->choice_2,
            'choice_3' => $request->choice_3,
            'status' => 'submitted',
            'registration_period_id' => $activePeriod->id,
        ];

        // Only generate registration number for new registrations
        if (!$existingRegistration || !$existingRegistration->registration_number) {
            $data['registration_number'] = Registration::generateRegistrationNumber($activePeriod);
        }

        Registration::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        $message = $existingRegistration ? 'Pendaftaran berhasil diperbarui!' : 'Pendaftaran berhasil dikirim!';
        return redirect()->route('student.pendaftaran.index')->with('success', $message);

    }
}
