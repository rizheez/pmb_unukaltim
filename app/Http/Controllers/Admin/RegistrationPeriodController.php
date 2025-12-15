<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationPeriod;
use Illuminate\Http\Request;

class RegistrationPeriodController extends Controller
{
    public function index()
    {
        // Auto-deactivate expired periods
        RegistrationPeriod::deactivateExpiredPeriods();

        $periods = RegistrationPeriod::latest()->paginate(10);

        return view('admin.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.periods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wave_number' => 'required|integer|min:1',
            'academic_year' => 'required|string|max:20',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quota' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Validate if period can be activated
        if ($validated['is_active']) {
            $startDate = \Carbon\Carbon::parse($validated['start_date']);
            $endDate = \Carbon\Carbon::parse($validated['end_date']);

            if (! now()->between($startDate, $endDate)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Periode tidak dapat diaktifkan karena tanggal sekarang di luar rentang periode.');
            }

            // Deactivate other periods if this one is active
            RegistrationPeriod::where('is_active', true)->update(['is_active' => false]);
        }

        RegistrationPeriod::create($validated);

        return redirect()->route('admin.periods.index')
            ->with('success', 'Periode berhasil ditambahkan.');
    }

    public function edit(RegistrationPeriod $period)
    {
        return view('admin.periods.edit', compact('period'));
    }

    public function update(Request $request, RegistrationPeriod $period)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wave_number' => 'required|integer|min:1',
            'academic_year' => 'required|string|max:20',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quota' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Validate if period can be activated
        if ($validated['is_active']) {
            $startDate = \Carbon\Carbon::parse($validated['start_date']);
            $endDate = \Carbon\Carbon::parse($validated['end_date']);

            if (! now()->between($startDate, $endDate)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Periode tidak dapat diaktifkan karena tanggal sekarang di luar rentang periode.');
            }

            // Deactivate other periods if this one is active
            RegistrationPeriod::where('id', '!=', $period->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $period->update($validated);

        return redirect()->route('admin.periods.index')
            ->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy(RegistrationPeriod $period)
    {
        $period->delete();

        return redirect()->back()
            ->with('success', 'Periode berhasil dihapus.');
    }

    public function toggleActive(RegistrationPeriod $period)
    {
        // Check if trying to activate
        if (! $period->is_active) {
            // Check if period can be activated
            if (! $period->canBeActivated()) {
                $message = 'Periode tidak dapat diaktifkan. ';

                if ($period->isExpired()) {
                    $message .= 'Periode sudah berakhir pada '.$period->end_date->format('d M Y').'.';
                } elseif ($period->isUpcoming()) {
                    $message .= 'Periode belum dimulai. Akan dimulai pada '.$period->start_date->format('d M Y').'.';
                }

                return redirect()->back()->with('error', $message);
            }

            // Deactivate all other periods
            RegistrationPeriod::where('is_active', true)->update(['is_active' => false]);
        }

        $period->update(['is_active' => ! $period->is_active]);

        return redirect()->back()
            ->with('success', 'Status Periode berhasil diubah.');
    }
}
