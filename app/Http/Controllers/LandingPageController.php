<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\LandingPageSetting;
use App\Models\RegistrationPeriod;

class LandingPageController extends Controller
{
    public function index()
    {
        // Get all landing page settings grouped by section
        $settings = LandingPageSetting::getAllGrouped();

        // Get active program studi with fakultas
        $fakultas = Fakultas::active()
            ->with(['programStudi' => function ($query) {
                $query->active()->orderBy('jenjang')->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        // Get active registration period
        $activePeriod = RegistrationPeriod::active()->first();

        return view('landing-page', compact('settings', 'fakultas', 'activePeriod'));
    }

    public function guide()
    {
        // Get settings for contact info
        $settings = LandingPageSetting::getAllGrouped();

        // Get active registration period
        $activePeriod = RegistrationPeriod::active()->first();

        return view('guide', compact('settings', 'activePeriod'));
    }
}
