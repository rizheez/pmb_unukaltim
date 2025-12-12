<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationType;
use Illuminate\Http\Request;

class RegistrationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = RegistrationType::orderBy('created_at', 'desc')->get();
        return view('admin.registration-types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.registration-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:registration_types,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        RegistrationType::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.registration-types.index')
            ->with('success', 'Jenis pendaftaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegistrationType $registrationType)
    {
        return view('admin.registration-types.edit', compact('registrationType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistrationType $registrationType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:registration_types,name,' . $registrationType->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $registrationType->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.registration-types.index')
            ->with('success', 'Jenis pendaftaran berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistrationType $registrationType)
    {
        $registrationType->delete();

        return redirect()->route('admin.registration-types.index')
            ->with('success', 'Jenis pendaftaran berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(RegistrationType $registrationType)
    {
        $registrationType->update([
            'is_active' => !$registrationType->is_active
        ]);

        return redirect()->route('admin.registration-types.index')
            ->with('success', 'Status berhasil diubah.');
    }
}
