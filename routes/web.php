<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dinas routes
Route::get('/dinas/dashboard', function () {
    return view('dinas.dashboard');
})->name('dinas.dashboard');

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
Route::middleware(function ($request, $next) {
    if (!session()->has('is_logged_in')) return redirect()->route('login');
    return $next($request);
})->group(function () {
    Route::get('/umkm/dashboard', function () {
        return view('umkm.dashboard');
    })->name('umkm.dashboard');

    Route::get('/umkm/event', function () {
        return view('umkm.event');
    })->name('umkm.event');
});

