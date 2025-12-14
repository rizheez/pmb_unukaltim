<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentBiodataController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/robots.txt', [SitemapController::class, 'robots']);

// Landing page (public)
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

Route::middleware(['auth', \App\Http\Middleware\StudentMiddleware::class, 'verified'])->group(function () {
    // Dashboard
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
        ->name('student.dashboard');

    // Biodata
    Route::get('/student/biodata', [StudentBiodataController::class, 'index'])
        ->name('student.biodata.index');
    // Edit points to Blade form
    Route::get('/student/biodata/edit', [StudentBiodataController::class, 'edit'])
        ->name('student.biodata.edit');
    // Update for form submission
    Route::put('/student/biodata', [StudentBiodataController::class, 'update'])
        ->name('student.biodata.update');

    // Pendaftaran
    Route::get('/student/pendaftaran', [StudentRegistrationController::class, 'index'])
        ->name('student.pendaftaran.index');
    Route::post('/student/pendaftaran', [StudentRegistrationController::class, 'store'])
        ->name('student.pendaftaran.store');

    // Verification
    Route::post('/student/verifications/mark-read', [\App\Http\Controllers\Student\VerificationController::class, 'markAsRead'])
        ->name('student.verifications.mark-read');
});

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Students
    Route::get('/students', [\App\Http\Controllers\Admin\StudentController::class, 'index'])->name('students.index');
    Route::get('/students/datatable', [\App\Http\Controllers\Admin\StudentController::class, 'datatable'])->name('students.datatable');
    Route::get('/students/export', [\App\Http\Controllers\Admin\StudentController::class, 'export'])->name('students.export');
    Route::get('/students/{id}', [\App\Http\Controllers\Admin\StudentController::class, 'show'])->name('students.show');
    Route::post('/students/{biodata}/verify', [\App\Http\Controllers\Admin\DocumentVerificationController::class, 'bulkVerify'])->name('students.verify');
    
    // Announcements
    Route::resource('announcements', \App\Http\Controllers\Admin\AnnouncementController::class);
    
    // Registration Periods
    Route::resource('periods', \App\Http\Controllers\Admin\RegistrationPeriodController::class);
    Route::post('/periods/{period}/toggle', [\App\Http\Controllers\Admin\RegistrationPeriodController::class, 'toggleActive'])->name('periods.toggle');
    
    // Registration Types
    Route::resource('registration-types', \App\Http\Controllers\Admin\RegistrationTypeController::class);
    Route::post('/registration-types/{registrationType}/toggle', [\App\Http\Controllers\Admin\RegistrationTypeController::class, 'toggleActive'])->name('registration-types.toggle');
    
    // Fakultas routes
    Route::resource('fakultas', \App\Http\Controllers\Admin\FakultasController::class);
    Route::post('/fakultas/{fakulta}/toggle', [\App\Http\Controllers\Admin\FakultasController::class, 'toggleActive'])->name('fakultas.toggle');
    
    // Program Studi routes
    Route::resource('program-studi', \App\Http\Controllers\Admin\ProgramStudiController::class);
    Route::post('/program-studi/{programStudi}/toggle', [\App\Http\Controllers\Admin\ProgramStudiController::class, 'toggleActive'])->name('program-studi.toggle');
    
    // User Management (Admin Only) - Logic check in Controller
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    
    // Landing Page Settings
    Route::get('/landing-page', [\App\Http\Controllers\Admin\LandingPageSettingController::class, 'edit'])->name('landing-page.edit');
    Route::put('/landing-page', [\App\Http\Controllers\Admin\LandingPageSettingController::class, 'update'])->name('landing-page.update');
});

// Profile routes (from Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
