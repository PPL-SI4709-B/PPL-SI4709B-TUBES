<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ReportReviewController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ScaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Require Login for Root (Dummy Middleware Check could go here, for now simple redirect)
// Use simple closure to emulate auth middleware since we are using dummy session auth
Route::get('/', function () {
    if (session()->has('is_logged_in')) {
        return redirect()->route('umkm.dashboard');
    }
    return redirect()->route('login');
});
Route::resource('category', CategoryController::class)->except(['show']);
Route::resource('region', RegionController::class)->except(['show']);
Route::resource('scale', ScaleController::class)->except(['show']);
// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dinas routes
Route::prefix('dinas')->name('dinas.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dinas.dashboard');
    })->name('dashboard');

    Route::get('/report', [ReportReviewController::class, 'index'])->name('report.index');
    Route::get('/report/{id}', [ReportReviewController::class, 'show'])->name('report.show');
    Route::put('/report/{id}', [ReportReviewController::class, 'update'])->name('report.update');
});

Route::prefix('dinas')->name('dinas.')->group(function () {
    Route::resource('program', ProgramController::class)->except(['show']);
    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('pengajuan/{pengajuan}', [PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::put('pengajuan/{pengajuan}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
    Route::put('pengajuan/{pengajuan}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject');
});

// UMKM Auth / Register flow
Route::prefix('umkm/register')->name('umkm.register.')->group(function () {
    Route::get('/step-1', function () { return view('umkm.register.step-1'); })->name('step-1');
    Route::post('/step-1', [AuthController::class, 'processRegisterStep1'])->name('step-1.post');

    Route::get('/step-2', function () { return view('umkm.register.step-2'); })->name('step-2');
    Route::post('/step-2', [AuthController::class, 'processRegisterStep2'])->name('step-2.post');

    Route::get('/step-3', function () { return view('umkm.register.step-3'); })->name('step-3');
    Route::post('/step-3', [AuthController::class, 'processRegisterStep3'])->name('step-3.post');
});

// UMKM General Routes (Dummy Protected)
Route::prefix('umkm')->group(function () {
    Route::get('/dashboard', function () {
        if (!session()->has('is_logged_in')) return redirect()->route('login');
        return view('umkm.dashboard');
    })->name('umkm.dashboard');

    Route::get('/event', [EventController::class, 'index'])->name('umkm.event');
});

Route::get('/event', function () {
        if (!session()->has('is_logged_in')) return redirect()->route('login');
        return view('umkm.event');
})->name('umkm.event');
