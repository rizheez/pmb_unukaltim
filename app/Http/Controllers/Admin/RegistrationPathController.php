<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationPath;
use Illuminate\Http\Request;

class RegistrationPathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paths = RegistrationPath::orderBy('name')->paginate(10);
        return view('admin.registration-paths.index', compact('paths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.registration-paths.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:registration_paths,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        RegistrationPath::create($validated);

        return redirect()->route('admin.registration-paths.index')
            ->with('success', 'Jalur pendaftaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RegistrationPath $registrationPath)
    {
        return view('admin.registration-paths.show', compact('registrationPath'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegistrationPath $registrationPath)
    {
        return view('admin.registration-paths.edit', compact('registrationPath'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistrationPath $registrationPath)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:registration_paths,name,' . $registrationPath->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $registrationPath->update($validated);

        return redirect()->route('admin.registration-paths.index')
            ->with('success', 'Jalur pendaftaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistrationPath $registrationPath)
    {
        // Check if path is being used
        if ($registrationPath->registrations()->count() > 0) {
            return redirect()->route('admin.registration-paths.index')
                ->with('error', 'Jalur pendaftaran tidak dapat dihapus karena masih digunakan.');
        }

        $registrationPath->delete();

        return redirect()->route('admin.registration-paths.index')
            ->with('success', 'Jalur pendaftaran berhasil dihapus.');
    }
}
