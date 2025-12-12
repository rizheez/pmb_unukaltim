<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentBiodataController;
use App\Http\Controllers\StudentRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('student.dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth', \App\Http\Middleware\StudentMiddleware::class])->group(function () {
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
    Route::get('/students/{id}', [\App\Http\Controllers\Admin\StudentController::class, 'show'])->name('students.show');
    Route::post('/students/{biodata}/verify', [\App\Http\Controllers\Admin\DocumentVerificationController::class, 'bulkVerify'])->name('students.verify');
    
    // Announcements
    Route::resource('announcements', \App\Http\Controllers\Admin\AnnouncementController::class);
    
    // Registration Periods
    Route::resource('periods', \App\Http\Controllers\Admin\RegistrationPeriodController::class);
    Route::post('/periods/{period}/toggle', [\App\Http\Controllers\Admin\RegistrationPeriodController::class, 'toggleActive'])->name('periods.toggle');
});

// Profile routes (from Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
