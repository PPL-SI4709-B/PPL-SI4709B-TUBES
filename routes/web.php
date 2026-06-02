<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportReviewController;
use App\Http\Controllers\ScaleController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\VerificationController;

// Root
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'dinas'
            ? redirect()->route('dinas.dashboard')
            : redirect()->route('umkm.dashboard');
    }
    return redirect()->route('login');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// UMKM Register
Route::prefix('umkm/register')->name('umkm.register.')->middleware('guest')->group(function () {
    Route::get('/step-1', fn () => view('umkm.register.step-1'))->name('step-1');
    Route::post('/step-1', [AuthController::class, 'processRegisterStep1'])->name('step-1.post');

    Route::get('/step-2', [AuthController::class, 'showRegisterStep2'])->name('step-2');
    Route::post('/step-2', [AuthController::class, 'processRegisterStep2'])->name('step-2.post');

    Route::get('/step-3', [AuthController::class, 'showRegisterStep3'])->name('step-3');
    Route::post('/step-3', [AuthController::class, 'processRegisterStep3'])->name('step-3.post');
});

// ─── UMKM Routes ──────────────────────────────────────────────────────────────
Route::prefix('umkm')->name('umkm.')->middleware(['auth', 'role:umkm'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'umkm'])->name('dashboard');

    Route::get('/profile', [UmkmController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UmkmController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UmkmController::class, 'update'])->name('profile.update');

    Route::get('/pengajuan', [PengajuanController::class, 'umkmIndex'])->name('pengajuan.index');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');

    Route::get('/event', [EventController::class, 'index'])->name('event');
    Route::get('/event/history', [EventController::class, 'history'])->name('event.history');
    Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
    
    Route::get('/event/{event}/feedback', [\App\Http\Controllers\EventFeedbackController::class, 'create'])->name('event-feedback.create');
    Route::post('/event/{event}/feedback', [\App\Http\Controllers\EventFeedbackController::class, 'store'])->name('event-feedback.store');
    
    Route::view('/panduan', 'umkm.panduan')->name('panduan');
});

// UMKM Reports
Route::middleware(['auth', 'role:umkm'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
});

// ─── Dinas Routes ─────────────────────────────────────────────────────────────
Route::prefix('dinas')->name('dinas.')->middleware(['auth', 'role:dinas'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dinas'])->name('dashboard');

    Route::resource('program', ProgramController::class)->except(['show']);
    Route::resource('category', CategoryController::class)->except(['show']);
    Route::resource('region', RegionController::class)->except(['show']);
    Route::resource('scale', ScaleController::class)->except(['show']);

    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('pengajuan/{pengajuan}', [PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::put('pengajuan/{pengajuan}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
    Route::put('pengajuan/{pengajuan}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject');

    Route::get('verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::put('verification/{user}/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::put('verification/{user}/reject', [VerificationController::class, 'reject'])->name('verification.reject');

    Route::get('report', [ReportReviewController::class, 'index'])->name('report.index');
    Route::get('report/{report}', [ReportReviewController::class, 'show'])->name('report.show');
    Route::put('report/{report}', [ReportReviewController::class, 'update'])->name('report.update');
});
