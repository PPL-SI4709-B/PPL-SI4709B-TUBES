<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DinasPendanaanVerifikasiController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventFeedbackController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\LaporanBerkalaController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MateriEdukasiUmkmController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PengajuanPendanaanController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportReviewController;
use App\Http\Controllers\ScaleController;
use App\Http\Controllers\SumberPendanaanController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

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

// Dokumen pendukung — privat, hanya pemilik atau petugas dinas (authz di controller)
Route::middleware('auth')->group(function () {
    Route::get('dokumen/pengajuan/{pengajuan}', [PengajuanController::class, 'dokumen'])->name('pengajuan.dokumen');
    Route::get('dokumen/pendanaan/{pengajuanPendanaan}', [PengajuanPendanaanController::class, 'dokumen'])->name('pendanaan.dokumen');
    Route::get('dokumen/laporan/{report}', [ReportController::class, 'lampiran'])->name('reports.lampiran');
});

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

    // PBI-22: Pengajuan Pendanaan UMKM
    Route::get('/pendanaan', [PengajuanPendanaanController::class, 'index'])->name('pendanaan.index');
    Route::get('/pendanaan/create', [PengajuanPendanaanController::class, 'create'])->name('pendanaan.create');
    Route::post('/pendanaan', [PengajuanPendanaanController::class, 'store'])->name('pendanaan.store');
    Route::get('/pendanaan/{pengajuanPendanaan}', [PengajuanPendanaanController::class, 'show'])->name('pendanaan.show');

    Route::get('/event', [EventController::class, 'index'])->name('event');
    Route::get('/event/history', [EventController::class, 'history'])->name('event.history');
    Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
    Route::post('/event/{event}/register', [EventRegistrationController::class, 'register'])->name('event.register');

    Route::get('/event/{event}/feedback', [EventFeedbackController::class, 'create'])->name('event-feedback.create');
    Route::post('/event/{event}/feedback', [EventFeedbackController::class, 'store'])->name('event-feedback.store');

    Route::view('/panduan', 'umkm.panduan')->name('panduan');

    // PBI-40 / PBI-42: static support pages
    Route::view('/notifikasi', 'umkm.notifikasi')->name('notifikasi');
    Route::view('/faq', 'umkm.faq')->name('faq');

    // PBI-39/40: in-app notifications (UMKM)
    Route::get('/notifications', [NotificationController::class, 'umkmIndex'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // PBI-38/39: Materi Edukasi (UMKM access + download)
    Route::get('/materi-edukasi', [MateriEdukasiUmkmController::class, 'index'])->name('materi-edukasi.index');
    Route::get('/materi-edukasi/{materiEdukasi}', [MateriEdukasiUmkmController::class, 'show'])->name('materi-edukasi.show');
    Route::get('/materi-edukasi/{materiEdukasi}/download', [MateriEdukasiUmkmController::class, 'download'])->name('materi-edukasi.download');

    // PBI-34/35/36: Laporan Perkembangan Usaha Berkala
    Route::get('/laporan-berkala', [LaporanBerkalaController::class, 'index'])->name('laporan_berkala.index');
    Route::get('/laporan-berkala/create', [LaporanBerkalaController::class, 'create'])->name('laporan_berkala.create');
    Route::post('/laporan-berkala', [LaporanBerkalaController::class, 'store'])->name('laporan_berkala.store');
    Route::get('/laporan-berkala/{id}/edit', [LaporanBerkalaController::class, 'edit'])->name('laporan_berkala.edit');
    Route::put('/laporan-berkala/{id}', [LaporanBerkalaController::class, 'update'])->name('laporan_berkala.update');
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
    Route::get('/dashboard/export-umkm', [DashboardController::class, 'exportUmkm'])->name('dashboard.export-umkm');

    Route::get('master-data', [MasterDataController::class, 'index'])->name('master-data');
    Route::resource('program', ProgramController::class);
    Route::resource('category', CategoryController::class)->except(['show']);
    Route::resource('region', RegionController::class)->except(['show']);
    Route::resource('scale', ScaleController::class)->except(['show']);
    Route::resource('sumber-pendanaan', SumberPendanaanController::class)->except(['show']);
    Route::get('pendanaan-verifikasi', [DinasPendanaanVerifikasiController::class, 'index'])
        ->name('pendanaan-verifikasi.index');
    Route::get('pendanaan-verifikasi/{pengajuanPendanaan}', [DinasPendanaanVerifikasiController::class, 'show'])
        ->name('pendanaan-verifikasi.show');
    Route::put('pendanaan-verifikasi/{pengajuanPendanaan}/approve', [DinasPendanaanVerifikasiController::class, 'approve'])
        ->name('pendanaan-verifikasi.approve');
    Route::put('pendanaan-verifikasi/{pengajuanPendanaan}/reject', [DinasPendanaanVerifikasiController::class, 'reject'])
        ->name('pendanaan-verifikasi.reject');

    // PBI-28: Event management (CRUD) by Dinas
    Route::get('event', [EventController::class, 'adminIndex'])->name('event.index');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('event', [EventController::class, 'store'])->name('event.store');
    Route::get('event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('event/{event}', [EventController::class, 'update'])->name('event.update');
    Route::delete('event/{event}', [EventController::class, 'destroy'])->name('event.destroy');

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

    // PBI-30: Report evaluation by Dinas
    Route::get('report/{report}/evaluate', [EvaluationController::class, 'create'])->name('evaluation.create');
    Route::post('report/{report}/evaluate', [EvaluationController::class, 'store'])->name('evaluation.store');
});
