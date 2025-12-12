<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['studentBiodata', 'registration'])
            ->where('role', 'student');
            
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $students = $query->paginate(10)
            ->withQueryString();

        return view('admin.students.index', [
            'students' => $students,
            'filters' => $request->only(['search']),
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
