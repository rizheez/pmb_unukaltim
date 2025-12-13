<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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

        $query = User::with(['studentBiodata', 'registration.registrationPeriod'])
            ->where('role', 'student');

        // Filter by Status
        if ($statusFilter && $statusFilter !== 'all') {
            if ($statusFilter === 'no_registration') {
                $query->doesntHave('registration');
            } else {
                $query->whereHas('registration', function ($q) use ($statusFilter) {
                    $q->where('status', $statusFilter);
                });
            }
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

        $totalRecords = User::where('role', 'student')->count();
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
                    ? '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">' . ucfirst($student->registration->status) . '</span>'
                    : '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Belum Daftar</span>',
                'period_name' => $student->registration && $student->registration->registrationPeriod
                    ? $student->registration->registrationPeriod->name
                    : '-',
                'registered_at' => $student->created_at->format('d M Y'),
                'actions' => '<a href="' . route('admin.students.show', $student->id) . '" class="text-indigo-600 hover:text-indigo-900">Detail</a>',
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
}
