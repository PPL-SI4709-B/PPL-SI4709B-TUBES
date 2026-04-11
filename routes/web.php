<?php

use Illuminate\Support\Facades\Route;

// Redirect root to dinas dashboard for testing
Route::redirect('/', '/dinas/dashboard');

// Dinas routes
Route::get('/dinas/dashboard', function () {
    return view('dinas.dashboard');
})->name('dinas.dashboard');

// UMKM Auth / Register flow
Route::get('/umkm/register/step-1', function () {
    return view('umkm.register.step-1');
})->name('umkm.register.step-1');

Route::get('/umkm/register/step-2', function () {
    return view('umkm.register.step-2');
})->name('umkm.register.step-2');

Route::get('/umkm/register/step-3', function () {
    return view('umkm.register.step-3');
})->name('umkm.register.step-3');

// UMKM General Routes
Route::get('/umkm/dashboard', function () {
    return view('umkm.dashboard');
})->name('umkm.dashboard');

Route::get('/umkm/event', function () {
    return view('umkm.event');
})->name('umkm.event');
