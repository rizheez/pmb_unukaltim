<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationPeriod;
use Illuminate\Http\Request;

class RegistrationPeriodController extends Controller
{
    public function index()
    {
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

        // Deactivate other periods if this one is active
        if ($validated['is_active']) {
            RegistrationPeriod::where('is_active', true)->update(['is_active' => false]);
        }

        RegistrationPeriod::create($validated);

        return redirect()->route('admin.periods.index')
            ->with('success', 'Period created successfully.');
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

        // Deactivate other periods if this one is active
        if ($validated['is_active']) {
            RegistrationPeriod::where('id', '!=', $period->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $period->update($validated);

        return redirect()->route('admin.periods.index')
            ->with('success', 'Period updated successfully.');
    }

    public function destroy(RegistrationPeriod $period)
    {
        $period->delete();

        return redirect()->back()
            ->with('success', 'Period deleted successfully.');
    }

    public function toggleActive(RegistrationPeriod $period)
    {
        if (!$period->is_active) {
            // Deactivate all other periods
            RegistrationPeriod::where('is_active', true)->update(['is_active' => false]);
        }

        $period->update(['is_active' => !$period->is_active]);

        return redirect()->back()
            ->with('success', 'Period status updated.');
    }
}
