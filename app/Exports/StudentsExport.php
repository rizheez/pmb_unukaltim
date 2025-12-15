<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromCollection, WithColumnFormatting, WithColumnWidths, WithHeadings, WithMapping, WithStyles
{
    protected $periodFilter;

    protected $statusFilter;

    public function __construct($periodFilter = null, $statusFilter = null)
    {
        $this->periodFilter = $periodFilter;
        $this->statusFilter = $statusFilter;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = User::with([
            'studentBiodata',
            'registration.registrationPeriod',
            'registration.registrationType',
            'registration.programStudiChoice1',
            'registration.programStudiChoice2',
            'registration.programStudiChoice3',
        ])->where('role', 'student')
            ->whereHas('registration');

        // Apply filters
        if ($this->statusFilter && $this->statusFilter !== 'all') {
            if ($this->statusFilter === 'no_registration') {
                $query->doesntHave('registration');
            } else {
                $query->whereHas('registration', function ($q) {
                    $q->where('status', $this->statusFilter);
                });
            }
        }

        if ($this->periodFilter && $this->periodFilter !== 'all') {
            $query->whereHas('registration', function ($q) {
                $q->where('registration_period_id', $this->periodFilter);
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Email',
            'Telepon',
            'NIK',
            'NISN',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Alamat',
            'Asal Sekolah',
            'Jurusan',
            'Status Pendaftaran',
            'Gelombang',
            'Jenis Pendaftaran',
            'Jalur Pendaftaran',
            'Pilihan 1',
            'Pilihan 2',
            'Pilihan 3',
            'Sumber Informasi',
            'Detail Sumber Informasi',
            'URL Foto',
            'URL KK',
            'URL KTP',
            'URL Ijazah/SKL',
            'Tanggal Daftar',
        ];
    }

    /**
     * @var User
     */
    public function map($student): array
    {
        static $no = 0;
        $no++;

        $biodata = $student->studentBiodata;
        $registration = $student->registration;

        return [
            $no,
            $biodata->name ?? '-',
            $student->email,
            $biodata->phone ?? $student->phone ?? '-',
            $biodata->nik ?? '-',
            $biodata->nisn ?? '-',
            $biodata->gender ?? '-',
            $biodata->birth_place ?? '-',
            $biodata->birth_date ?? '-',
            $biodata->religion ?? '-',
            $biodata->address ?? '-',
            $biodata->school_origin ?? '-',
            $biodata->major ?? '-',
            $registration ? ucfirst($registration->status) : 'Belum Daftar',
            $registration && $registration->registrationPeriod ? $registration->registrationPeriod->name : '-',
            $registration && $registration->registrationType ? $registration->registrationType->name : '-',
            $registration && $registration->registration_path ? $registration->registration_path : '-',
            $registration && $registration->programStudiChoice1 ? $registration->programStudiChoice1->full_name : '-',
            $registration && $registration->programStudiChoice2 ? $registration->programStudiChoice2->full_name : '-',
            $registration && $registration->programStudiChoice3 ? $registration->programStudiChoice3->full_name : '-',
            $registration && $registration->referral_source ? $registration->referral_source : '-',
            $registration && $registration->referral_detail ? $registration->referral_detail : '-',
            $biodata && $biodata->photo_path ? url(Storage::url($biodata->photo_path)) : '-',
            $biodata && $biodata->kk_path ? url(Storage::url($biodata->kk_path)) : '-',
            $biodata && $biodata->ktp_path ? url(Storage::url($biodata->ktp_path)) : '-',
            $biodata && $biodata->certificate_path ? url(Storage::url($biodata->certificate_path)) : '-',
            $student->created_at->format('d-m-Y H:i:s'),
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text with background color
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5'],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 25,  // Nama Lengkap
            'C' => 30,  // Email
            'D' => 15,  // Telepon
            'E' => 20,  // NIK
            'F' => 15,  // NISN
            'G' => 15,  // Jenis Kelamin
            'H' => 20,  // Tempat Lahir
            'I' => 15,  // Tanggal Lahir
            'J' => 15,  // Agama
            'K' => 35,  // Alamat
            'L' => 30,  // Asal Sekolah
            'M' => 20,  // Jurusan
            'N' => 20,  // Status Pendaftaran
            'O' => 25,  // Gelombang
            'P' => 25,  // Jenis Pendaftaran
            'Q' => 20,  // Jalur Pendaftaran
            'R' => 35,  // Pilihan 1
            'S' => 35,  // Pilihan 2
            'T' => 35,  // Pilihan 3
            'U' => 30,  // Sumber Informasi
            'V' => 30,  // Detail Sumber Informasi
            'W' => 50,  // URL Foto
            'X' => 50,  // URL KK
            'Y' => 50,  // URL KTP
            'Z' => 50,  // URL Ijazah/SKL
            'AA' => 20, // Tanggal Daftar
        ];
    }

    /**
     * Format all columns as text to prevent auto-formatting
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT, // NIK - prevent scientific notation
            'F' => NumberFormat::FORMAT_TEXT, // NISN - prevent scientific notation
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_TEXT,
            'L' => NumberFormat::FORMAT_TEXT,
            'M' => NumberFormat::FORMAT_TEXT,
            'N' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_TEXT,
            'P' => NumberFormat::FORMAT_TEXT,
            'Q' => NumberFormat::FORMAT_TEXT,
            'R' => NumberFormat::FORMAT_TEXT,
            'S' => NumberFormat::FORMAT_TEXT,
            'T' => NumberFormat::FORMAT_TEXT,
            'U' => NumberFormat::FORMAT_TEXT,
            'V' => NumberFormat::FORMAT_TEXT,
            'W' => NumberFormat::FORMAT_TEXT,
            'X' => NumberFormat::FORMAT_TEXT,
            'Y' => NumberFormat::FORMAT_TEXT,
            'Z' => NumberFormat::FORMAT_TEXT,
            'AA' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
