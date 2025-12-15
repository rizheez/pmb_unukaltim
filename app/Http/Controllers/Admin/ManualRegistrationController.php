<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Registration;
use App\Models\RegistrationPeriod;
use App\Models\RegistrationType;
use App\Models\StudentBiodata;
use App\Models\User;
use App\Notifications\StudentAccountCreated;
use App\Services\ImageOptimizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManualRegistrationController extends Controller
{
    protected $imageOptimizer;

    public function __construct(ImageOptimizationService $imageOptimizer)
    {
        $this->imageOptimizer = $imageOptimizer;
    }

    public function create()
    {
        // Check if there's an active registration period
        $activePeriod = RegistrationPeriod::active()->first();

        if (! $activePeriod) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Tidak ada periode pendaftaran yang aktif saat ini.');
        }

        $registrationTypes = RegistrationType::active()->get();
        $registrationPaths = ['Umum', 'Kelas Karyawan'];

        // Get active program studi grouped by fakultas
        $fakultas = Fakultas::active()
            ->with(['programStudi' => function ($query) {
                $query->active()->orderBy('jenjang')->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        return view('admin.manual-registration.create', compact(
            'activePeriod',
            'registrationTypes',
            'registrationPaths',
            'fakultas'
        ));
    }

    public function store(Request $request)
    {
        // Check if there's an active period
        $activePeriod = RegistrationPeriod::active()->first();

        if (! $activePeriod) {
            return redirect()->back()->with('error', 'Tidak ada periode pendaftaran yang aktif saat ini.');
        }

        // Validate all input
        $request->validate([
            // User data
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',

            // Biodata
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:student_biodatas,nik',
            'nisn' => 'nullable|numeric|unique:student_biodatas,nisn',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date|before:-15 years',
            'religion' => 'required|string|max:255',
            'address' => 'required|string',
            'school_origin' => 'required|string',
            'last_education' => 'required|string',
            'major' => 'nullable|string',

            // Documents
            'photo' => 'required|image|max:1024',
            'ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            // Registration
            'registration_type_id' => 'required|exists:registration_types,id',
            'registration_path' => 'required|in:Umum,Kelas Karyawan',
            'referral_source' => 'nullable|string|max:255',
            'referral_detail' => 'required_if:referral_source,Lainnya,Dosen/Panitia PMB UNU Kaltim|nullable|string|max:255',
            'choice_1' => 'required|exists:program_studi,id',
            'choice_2' => 'required|exists:program_studi,id|different:choice_1',
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

        DB::beginTransaction();

        try {
            // Generate random password
            $password = 'pmbunukaltim';

            // Create user account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($password),
                'role' => 'student',
                'email_verified_at' => now(), // Auto-verify for manual registration
            ]);

            // Handle file uploads
            $photoPath = $this->imageOptimizer->optimizePhoto(
                $request->file('photo'),
                'students/photos'
            );

            $ktpPath = $this->imageOptimizer->optimizeDocument(
                $request->file('ktp'),
                'students/ktp'
            );

            $kkPath = $this->imageOptimizer->optimizeDocument(
                $request->file('kk'),
                'students/kk'
            );

            $certificatePath = null;
            if ($request->hasFile('certificate')) {
                $certificatePath = $this->imageOptimizer->optimizeDocument(
                    $request->file('certificate'),
                    'students/certificates'
                );
            }

            // Create biodata
            $biodata = StudentBiodata::create([
                'user_id' => $user->id,
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
                'photo_path' => $photoPath,
                'ktp_path' => $ktpPath,
                'kk_path' => $kkPath,
                'certificate_path' => $certificatePath,
            ]);

            // Create registration
            Registration::create([
                'user_id' => $user->id,
                'registration_type_id' => $request->registration_type_id,
                'registration_path' => $request->registration_path,
                'referral_source' => $request->referral_source,
                'referral_detail' => $request->referral_detail,
                'choice_1' => $request->choice_1,
                'choice_2' => $request->choice_2,
                'status' => 'submitted',
                'registration_period_id' => $activePeriod->id,
            ]);

            // Send email notification with credentials
            $user->notify(new StudentAccountCreated($password));

            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('success', "Pendaftaran berhasil! Email dengan kredensial login telah dikirim ke {$user->email}");
        } catch (\Exception $e) {
            DB::rollBack();

            // Clean up uploaded files if any
            if (isset($photoPath)) {
                $this->imageOptimizer->deleteOldImage($photoPath);
            }
            if (isset($ktpPath)) {
                $this->imageOptimizer->deleteOldImage($ktpPath);
            }
            if (isset($kkPath)) {
                $this->imageOptimizer->deleteOldImage($kkPath);
            }
            if (isset($certificatePath)) {
                $this->imageOptimizer->deleteOldImage($certificatePath);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}
