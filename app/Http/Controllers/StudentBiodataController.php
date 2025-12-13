<?php

namespace App\Http\Controllers;

use App\Models\StudentBiodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentBiodataController extends Controller
{
    public function index()
    {
        $biodata = StudentBiodata::where('user_id', Auth::id())->first();
        return view('student.biodata.index', compact('biodata'));
    }

    public function edit()
    {
        // Check if there's an active registration period
        $activePeriod = \App\Models\RegistrationPeriod::active()->first();
        
        if (!$activePeriod) {
            return redirect()->route('student.biodata.index')
                ->with('error', 'Tidak ada periode pendaftaran yang aktif saat ini. Biodata tidak dapat diubah.');
        }

        // Get or create biodata for the current user
        $biodata = StudentBiodata::firstOrNew(['user_id' => Auth::id()]);

        return view('student.biodata.edit', compact('biodata'));
    }

    // kept for compatibility if needed, but Livewire handles update
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                'unique:student_biodatas,nik,' . (StudentBiodata::where('user_id', Auth::id())->first()->id ?? 'NULL')
            ],
            'nisn' => [
                'nullable',
                'numeric',
                'unique:student_biodatas,nisn,' . (StudentBiodata::where('user_id', Auth::id())->first()->id ?? 'NULL')
            ],
            'phone' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'photo' => 'nullable|image|max:1024', // 1MB Max
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB Max
            'kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB Max
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB Max
            'birth_date' => 'required|date',
            'school_origin' => 'required|string',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'last_education' => $request->last_education,
            'school_origin' => $request->school_origin,
            'major' => $request->major,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
        ];

        // Get existing biodata to check for old files
        $existingBiodata = StudentBiodata::where('user_id', Auth::id())->first();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($existingBiodata && $existingBiodata->photo_path) {
                \Storage::disk('public')->delete($existingBiodata->photo_path);
            }
            $path = $request->file('photo')->store('students/photos', 'public');
            $data['photo_path'] = $path;
        }

        // Handle KTP upload
        if ($request->hasFile('ktp')) {
            // Delete old KTP if exists
            if ($existingBiodata && $existingBiodata->ktp_path) {
                \Storage::disk('public')->delete($existingBiodata->ktp_path);
            }
            $path = $request->file('ktp')->store('students/ktp', 'public');
            $data['ktp_path'] = $path;
        }

        // Handle KK upload
        if ($request->hasFile('kk')) {
            // Delete old KK if exists
            if ($existingBiodata && $existingBiodata->kk_path) {
                \Storage::disk('public')->delete($existingBiodata->kk_path);
            }
            $path = $request->file('kk')->store('students/kk', 'public');
            $data['kk_path'] = $path;
        }

        // Handle Certificate upload
        if ($request->hasFile('certificate')) {
            // Delete old certificate if exists
            if ($existingBiodata && $existingBiodata->certificate_path) {
                \Storage::disk('public')->delete($existingBiodata->certificate_path);
            }
            $path = $request->file('certificate')->store('students/certificates', 'public');
            $data['certificate_path'] = $path;
        }

        StudentBiodata::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return redirect()->route('student.biodata.index')->with('message', 'Biodata berhasil disimpan.');
    }
}
