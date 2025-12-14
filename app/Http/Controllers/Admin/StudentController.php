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
                    ->orWhere('phone', 'like', "%{$search}%");
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
}
