<?php

namespace App\Http\Controllers;

use App\Models\StudentBiodata;
use App\Services\ImageOptimizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentBiodataController extends Controller
{
    protected $imageOptimizer;

    public function __construct(ImageOptimizationService $imageOptimizer)
    {
        $this->imageOptimizer = $imageOptimizer;
    }

    public function index()
    {
        $biodata = StudentBiodata::where('user_id', Auth::id())->first();

        return view('student.biodata.index', compact('biodata'));
    }

    public function edit()
    {
        // Check if there's an active registration period
        $activePeriod = \App\Models\RegistrationPeriod::active()->first();

        if (! $activePeriod) {
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
        // Get existing biodata to check for old files
        $existingBiodata = StudentBiodata::where('user_id', Auth::id())->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                'unique:student_biodatas,nik,'.($existingBiodata->id ?? 'NULL'),
            ],
            'nisn' => [
                'nullable',
                'numeric',
                'unique:student_biodatas,nisn,'.($existingBiodata->id ?? 'NULL'),
            ],
            'phone' => 'required|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'birth_place' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'address' => 'required|string',
            'photo' => ($existingBiodata && $existingBiodata->photo_path ? 'nullable' : 'required').'|image|max:1024', // 1MB Max
            'ktp' => ($existingBiodata && $existingBiodata->ktp_path ? 'nullable' : 'required').'|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB Max
            'kk' => ($existingBiodata && $existingBiodata->kk_path ? 'nullable' : 'required').'|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB Max
            'certificate' => ($existingBiodata && $existingBiodata->certificate_path ? 'nullable' : 'required').'|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB Max
            'birth_date' => 'required|date|before:-15 years',
            'school_origin' => 'required|string',
        ], [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'numeric' => ':attribute harus berupa angka.',
            'digits' => ':attribute harus berjumlah :digits digit.',
            'unique' => ':attribute sudah terdaftar dalam sistem.',
            'in' => 'Pilihan :attribute tidak valid.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => 'Format file :attribute harus berupa: :values.',
            'date' => ':attribute bukan tanggal yang valid.',
            'birth_date.before' => 'Umur Anda harus minimal 15 tahun untuk mendaftar.',

            // Pesan spesifik untuk ukuran file
            'photo.max' => 'Ukuran Foto maksimal 1MB.',
            'ktp.max' => 'Ukuran file KTP maksimal 2MB.',
            'kk.max' => 'Ukuran file KK maksimal 2MB.',
            'certificate.max' => 'Ukuran file Ijazah maksimal 2MB.',
        ], [
            'name' => 'Nama Lengkap',
            'nik' => 'NIK',
            'nisn' => 'NISN',
            'phone' => 'Nomor Telepon',
            'gender' => 'Jenis Kelamin',
            'birth_place' => 'Tempat Lahir',
            'religion' => 'Agama',
            'address' => 'Alamat Lengkap',
            'photo' => 'Foto',
            'ktp' => 'File KTP',
            'kk' => 'File KK',
            'certificate' => 'File Ijazah',
            'birth_date' => 'Tanggal Lahir',
            'school_origin' => 'Asal Sekolah',
            'major' => 'Jurusan Sekolah',
            'last_education' => 'Pendidikan Terakhir',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'birth_place' => $request->birth_place,
            'religion' => $request->religion,
            'address' => $request->address,
            'last_education' => $request->last_education,
            'school_origin' => $request->school_origin,
            'major' => $request->major,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
        ];

        // Handle photo upload with optimization
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            $this->imageOptimizer->deleteOldImage($existingBiodata?->photo_path);

            // Optimize and store (max 800px, quality 85%)
            $data['photo_path'] = $this->imageOptimizer->optimizePhoto(
                $request->file('photo'),
                'students/photos'
            );
        }

        // Handle KTP upload with optimization
        if ($request->hasFile('ktp')) {
            // Delete old KTP if exists
            $this->imageOptimizer->deleteOldImage($existingBiodata?->ktp_path);

            // Optimize and store (max 1920px, quality 90% for document clarity)
            $data['ktp_path'] = $this->imageOptimizer->optimizeDocument(
                $request->file('ktp'),
                'students/ktp'
            );
        }

        // Handle KK upload with optimization
        if ($request->hasFile('kk')) {
            // Delete old KK if exists
            $this->imageOptimizer->deleteOldImage($existingBiodata?->kk_path);

            // Optimize and store (max 1920px, quality 90% for document clarity)
            $data['kk_path'] = $this->imageOptimizer->optimizeDocument(
                $request->file('kk'),
                'students/kk'
            );
        }

        // Handle Certificate upload with optimization
        if ($request->hasFile('certificate')) {
            // Delete old certificate if exists
            $this->imageOptimizer->deleteOldImage($existingBiodata?->certificate_path);

            // Optimize and store (max 1920px, quality 90% for document clarity)
            $data['certificate_path'] = $this->imageOptimizer->optimizeDocument(
                $request->file('certificate'),
                'students/certificates'
            );
        }

        StudentBiodata::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return redirect()->route('student.biodata.index')->with('message', 'Biodata berhasil disimpan.');
    }
}
