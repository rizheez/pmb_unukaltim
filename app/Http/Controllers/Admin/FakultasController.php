<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fakultas = Fakultas::withCount('programStudi')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.fakultas.index', compact('fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:fakultas,code',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Fakultas::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.fakultas.index')
            ->with('success', 'Fakultas berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fakultas $fakulta)
    {
        return view('admin.fakultas.edit', compact('fakulta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fakultas $fakulta)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:fakultas,code,' . $fakulta->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $fakulta->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.fakultas.index')
            ->with('success', 'Fakultas berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fakultas $fakulta)
    {
        // Check if fakultas has program studi
        if ($fakulta->programStudi()->count() > 0) {
            return redirect()->route('admin.fakultas.index')
                ->with('error', 'Tidak dapat menghapus fakultas yang memiliki program studi.');
        }

        $fakulta->delete();

        return redirect()->route('admin.fakultas.index')
            ->with('success', 'Fakultas berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Fakultas $fakulta)
    {
        $fakulta->update([
            'is_active' => !$fakulta->is_active
        ]);

        return redirect()->route('admin.fakultas.index')
            ->with('success', 'Status berhasil diubah.');
    }
}
