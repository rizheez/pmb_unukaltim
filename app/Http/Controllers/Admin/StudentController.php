<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $periods = \App\Models\RegistrationPeriod::orderBy('start_date', 'desc')->get();

        return view('admin.students.index', compact('periods'));
    }

    public function datatable(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start', 0);
        $length = $request->get('length', 10);
        $search = $request->get('search')['value'] ?? '';
        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 'asc';
        $statusFilter = $request->get('status_filter'); // Filter status
        $periodFilter = $request->get('period_filter'); // Filter period
        $columns = ['name', 'email', 'phone', 'created_at'];
        $orderBy = $columns[$orderColumn] ?? 'created_at';

        // Hanya tampilkan mahasiswa yang sudah mendaftar (punya registration)
        $query = User::with(['studentBiodata', 'registration.registrationPeriod'])
            ->where('role', 'student')
            ->whereHas('registration'); // Exclude yang belum daftar

        // Filter by Status
        if ($statusFilter && $statusFilter !== 'all') {
            $query->whereHas('registration', function ($q) use ($statusFilter) {
                $q->where('status', $statusFilter);
            });
        }

        // Filter by Period
        if ($periodFilter && $periodFilter !== 'all') {
            $query->whereHas('registration', function ($q) use ($periodFilter) {
                $q->where('registration_period_id', $periodFilter);
            });
        }

        // Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhereHas('registration', function ($regQuery) use ($search) {
                        $regQuery->where('referral_source', 'like', "%{$search}%")
                            ->orWhere('referral_detail', 'like', "%{$search}%");
                    });
            });
        }

        // Hanya hitung mahasiswa yang sudah mendaftar
        $totalRecords = User::where('role', 'student')->whereHas('registration')->count();
        $filteredRecords = $query->count();

        $students = $query->orderBy($orderBy, $orderDir)
            ->skip($start)
            ->take($length)
            ->get();

        $data = $students->map(function ($student) {
            // Format referral info
            $referralInfo = '-';
            if ($student->registration && $student->registration->referral_source) {
                $source = $student->registration->referral_source;
                $detail = $student->registration->referral_detail;

                if ($detail) {
                    $referralInfo = '<div class="text-sm"><div class="font-medium text-gray-900">'.e($source).'</div><div class="text-gray-500 text-xs mt-0.5">'.e($detail).'</div></div>';
                } else {
                    $referralInfo = '<div class="text-sm text-gray-900">'.e($source).'</div>';
                }
            }

            return [
                'name' => $student->name,
                'email' => $student->email,
                'phone' => $student->phone ?? '-',
                'status' => $student->registration
                    ? '<span class="px-2 py-1 text-xs rounded-full '.$student->registration->status_badge_class.'">'.$student->registration->status_label.'</span>'
                    : '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Belum Daftar</span>',
                'period_name' => $student->registration && $student->registration->registrationPeriod
                    ? $student->registration->registrationPeriod->name
                    : '-',
                'referral_source' => $referralInfo,
                'registered_at' => optional($student->created_at)
                    ->locale('id')
                    ->translatedFormat('d F Y'),
                'actions' => '<a href="'.route('admin.students.show', $student->id).'" class="text-indigo-600 hover:text-indigo-900">Detail</a>',
            ];
        });

        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        $student = User::with(['studentBiodata.verifications.verifier', 'registration'])
            ->where('role', 'student')
            ->findOrFail($id);

        return view('admin.students.show', [
            'student' => $student,
        ]);
    }

    public function export(Request $request)
    {
        $periodFilter = $request->get('period_filter');
        $statusFilter = $request->get('status_filter');

        $filename = 'Data_Calon_Mahasiswa_'.date('Y-m-d_His').'.xlsx';

        return Excel::download(
            new StudentsExport($periodFilter, $statusFilter),
            $filename
        );
    }

    public function editBiodata($id)
    {
        $student = User::with(['studentBiodata', 'registration'])
            ->where('role', 'student')
            ->findOrFail($id);

        if (! $student->studentBiodata) {
            return redirect()->route('admin.students.show', $student->id)
                ->with('error', 'Biodata mahasiswa tidak ditemukan.');
        }

        $programStudis = \App\Models\ProgramStudi::with('fakultas')
            ->where('is_active', true)
            ->get()
            ->groupBy('fakultas.name');

        $fakultas = \App\Models\Fakultas::with(['programStudi' => function ($query) {
            $query->where('is_active', true);
        }])->get();

        $registrationTypes = \App\Models\RegistrationType::where('is_active', true)->get();
        $registrationPaths = ['Umum', 'Kelas Karyawan'];

        return view('admin.students.edit-biodata', compact('student', 'programStudis', 'fakultas', 'registrationTypes', 'registrationPaths'));
    }

    public function updateBiodata(Request $request, $id)
    {
        $student = User::with('studentBiodata')->findOrFail($id);

        if (! $student->studentBiodata) {
            return redirect()->route('admin.students.show', $student->id)
                ->with('error', 'Biodata mahasiswa tidak ditemukan.');
        }

        // Validate all input
        $request->validate([
            // User data
            'email' => 'required|email|unique:users,email,'.$student->id,
            'phone' => 'required|string',

            // Biodata
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:student_biodatas,nik,'.$student->studentBiodata->id,
            'nisn' => 'nullable|numeric|unique:student_biodatas,nisn,'.$student->studentBiodata->id,
            'gender' => 'required|in:Laki-laki,Perempuan',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date|before:-15 years',
            'religion' => 'required|string|max:255',
            'address' => 'required|string',
            'school_origin' => 'required|string',
            'last_education' => 'required|string',
            'major' => 'nullable|string',

            // Documents (optional for update)
            'photo' => 'nullable|image|max:1024',
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            // Registration (if exists)
            'registration_type_id' => 'nullable|exists:registration_types,id',
            'registration_path' => 'nullable|in:Umum,Kelas Karyawan',
            'referral_source' => 'nullable|string|max:255',
            'referral_detail' => 'required_if:referral_source,Lainnya,Dosen/Panitia PMB UNU Kaltim|nullable|string|max:255',
            'choice_1' => 'nullable|exists:program_studi,id',
            'choice_2' => 'nullable|exists:program_studi,id|different:choice_1',
        ], [
            'required' => ':attribute wajib diisi.',
            'email' => ':attribute harus berupa email yang valid.',
            'unique' => ':attribute sudah terdaftar dalam sistem.',
            'numeric' => ':attribute harus berupa angka.',
            'digits' => ':attribute harus berjumlah :digits digit.',
            'in' => 'Pilihan :attribute tidak valid.',
            'exists' => ':attribute tidak valid.',
            'different' => 'Program studi :attribute tidak boleh sama.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => 'Format file :attribute harus berupa: :values.',
            'birth_date.before' => 'Umur minimal 15 tahun untuk mendaftar.',
            'photo.max' => 'Ukuran Foto maksimal 1MB.',
            'ktp.max' => 'Ukuran file KTP maksimal 2MB.',
            'kk.max' => 'Ukuran file KK maksimal 2MB.',
            'certificate.max' => 'Ukuran file Ijazah maksimal 2MB.',
            'required_if' => ':attribute wajib diisi jika memilih "Lainnya".',
        ], [
            'email' => 'Email',
            'phone' => 'Nomor Telepon',
            'name' => 'Nama Lengkap',
            'nik' => 'NIK',
            'nisn' => 'NISN',
            'gender' => 'Jenis Kelamin',
            'birth_place' => 'Tempat Lahir',
            'birth_date' => 'Tanggal Lahir',
            'religion' => 'Agama',
            'address' => 'Alamat Lengkap',
            'school_origin' => 'Asal Sekolah',
            'last_education' => 'Pendidikan Terakhir',
            'major' => 'Jurusan Sekolah',
            'photo' => 'Foto',
            'ktp' => 'File KTP',
            'kk' => 'File KK',
            'certificate' => 'File Ijazah',
            'registration_type_id' => 'Jenis Pendaftaran',
            'registration_path' => 'Jalur Pendaftaran',
            'referral_source' => 'Sumber Informasi',
            'referral_detail' => 'Detail Sumber Informasi',
            'choice_1' => 'Pilihan 1',
            'choice_2' => 'Pilihan 2',
        ]);

        \DB::beginTransaction();

        try {
            // Update user account
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            // Handle file uploads if provided
            $imageOptimizer = app(\App\Services\ImageOptimizationService::class);

            $biodataData = [
                'name' => $request->name,
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'religion' => $request->religion,
                'address' => $request->address,
                'last_education' => $request->last_education,
                'school_origin' => $request->school_origin,
                'major' => $request->major,
                'phone' => $request->phone,
                'gender' => $request->gender,
            ];

            if ($request->hasFile('photo')) {
                // Delete old photo
                if ($student->studentBiodata->photo_path) {
                    $imageOptimizer->deleteOldImage($student->studentBiodata->photo_path);
                }
                $biodataData['photo_path'] = $imageOptimizer->optimizePhoto(
                    $request->file('photo'),
                    'students/photos'
                );
            }

            if ($request->hasFile('ktp')) {
                if ($student->studentBiodata->ktp_path) {
                    $imageOptimizer->deleteOldImage($student->studentBiodata->ktp_path);
                }
                $biodataData['ktp_path'] = $imageOptimizer->optimizeDocument(
                    $request->file('ktp'),
                    'students/ktp'
                );
            }

            if ($request->hasFile('kk')) {
                if ($student->studentBiodata->kk_path) {
                    $imageOptimizer->deleteOldImage($student->studentBiodata->kk_path);
                }
                $biodataData['kk_path'] = $imageOptimizer->optimizeDocument(
                    $request->file('kk'),
                    'students/kk'
                );
            }

            if ($request->hasFile('certificate')) {
                if ($student->studentBiodata->certificate_path) {
                    $imageOptimizer->deleteOldImage($student->studentBiodata->certificate_path);
                }
                $biodataData['certificate_path'] = $imageOptimizer->optimizeDocument(
                    $request->file('certificate'),
                    'students/certificates'
                );
            }

            // Update biodata
            $student->studentBiodata->update($biodataData);

            // Update registration if exists and data provided
            if ($student->registration && $request->filled('registration_type_id')) {
                $student->registration->update([
                    'registration_type_id' => $request->registration_type_id,
                    'registration_path' => $request->registration_path,
                    'referral_source' => $request->referral_source,
                    'referral_detail' => $request->referral_detail,
                    'choice_1' => $request->choice_1,
                    'choice_2' => $request->choice_2,
                ]);
            }

            \DB::commit();

            return redirect()->route('admin.students.show', $student->id)
                ->with('success', 'Biodata mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            \DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}
