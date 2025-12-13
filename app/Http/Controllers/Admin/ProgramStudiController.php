<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProgramStudi::with('fakultas');

        // Filter by fakultas if provided
        if ($request->has('fakultas_id') && $request->fakultas_id != '') {
            $query->where('fakultas_id', $request->fakultas_id);
        }

        $programStudi = $query->orderBy('created_at', 'desc')->get();
        $fakultas = Fakultas::active()->orderBy('name')->get();

        return view('admin.program-studi.index', compact('programStudi', 'fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::active()->orderBy('name')->get();
        return view('admin.program-studi.create', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:program_studi,code',
            'jenjang' => 'required|in:D3,D4,S1,S2,S3',
            'description' => 'nullable|string',
            'quota' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        ProgramStudi::create([
            'fakultas_id' => $request->fakultas_id,
            'name' => $request->name,
            'code' => $request->code,
            'jenjang' => $request->jenjang,
            'description' => $request->description,
            'quota' => $request->quota,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program studi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudi $programStudi)
    {
        $fakultas = Fakultas::active()->orderBy('name')->get();
        return view('admin.program-studi.edit', compact('programStudi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramStudi $programStudi)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:program_studi,code,' . $programStudi->id,
            'jenjang' => 'required|in:D3,D4,S1,S2,S3',
            'description' => 'nullable|string',
            'quota' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $programStudi->update([
            'fakultas_id' => $request->fakultas_id,
            'name' => $request->name,
            'code' => $request->code,
            'jenjang' => $request->jenjang,
            'description' => $request->description,
            'quota' => $request->quota,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program studi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        // Check if program studi is used in registrations
        $hasRegistrations = \App\Models\Registration::where('choice_1', $programStudi->id)
            ->orWhere('choice_2', $programStudi->id)
            ->orWhere('choice_3', $programStudi->id)
            ->exists();

        if ($hasRegistrations) {
            return redirect()->route('admin.program-studi.index')
                ->with('error', 'Tidak dapat menghapus program studi yang sudah digunakan dalam pendaftaran.');
        }

        $programStudi->delete();

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program studi berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(ProgramStudi $programStudi)
    {
        $programStudi->update([
            'is_active' => !$programStudi->is_active
        ]);

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Status berhasil diubah.');
    }
}
