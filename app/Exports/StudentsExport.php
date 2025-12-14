<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Storage;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
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
            'registration.programStudiChoice3'
        ])->where('role', 'student');

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

    /**
     * @return array
     */
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
            'Pilihan 1',
            'Pilihan 2',
            'Pilihan 3',
            'URL Foto',
            'URL KK',
            'URL KTP',
            'URL Ijazah/SKL',
            'Tanggal Daftar',
        ];
    }

    /**
     * @var User $student
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
            $registration && $registration->programStudiChoice1 ? $registration->programStudiChoice1->full_name : '-',
            $registration && $registration->programStudiChoice2 ? $registration->programStudiChoice2->full_name : '-',
            $registration && $registration->programStudiChoice3 ? $registration->programStudiChoice3->full_name : '-',
            $biodata && $biodata->photo_path ? url(Storage::url($biodata->photo_path)) : '-',
            $biodata && $biodata->kk_path ? url(Storage::url($biodata->kk_path)) : '-',
            $biodata && $biodata->ktp_path ? url(Storage::url($biodata->ktp_path)) : '-',
            $biodata && $biodata->certificate_path ? url(Storage::url($biodata->certificate_path)) : '-',
            $student->created_at->format('d-m-Y H:i:s'),
        ];
    }

    /**
     * @param Worksheet $sheet
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
                    'startColor' => ['rgb' => '4F46E5']
                ],
            ],
        ];
    }

    /**
     * @return array
     */
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
            'Q' => 35,  // Pilihan 1
            'R' => 35,  // Pilihan 2
            'S' => 35,  // Pilihan 3
            'T' => 50,  // URL Foto
            'U' => 50,  // URL KK
            'V' => 50,  // URL KTP
            'W' => 50,  // URL Ijazah/SKL
            'X' => 20,  // Tanggal Daftar
        ];
    }
}
