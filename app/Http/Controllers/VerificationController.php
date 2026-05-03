<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        $pending  = User::where('role', 'umkm')->where('profile_status', 'pending')->latest()->get();
        $verified = User::where('role', 'umkm')->where('profile_status', 'verified')->latest()->get();
        $rejected = User::where('role', 'umkm')->where('profile_status', 'rejected')->latest()->get();

        return view('dinas.verification.index', compact('pending', 'verified', 'rejected'));
    }

    public function verify(User $user)
    {
        $user->update(['profile_status' => 'verified']);

        return redirect()->route('dinas.verification.index')
            ->with('success', "UMKM {$user->name} berhasil diverifikasi.");
    }

    public function reject(Request $request, User $user)
    {
        $user->update(['profile_status' => 'rejected']);

        return redirect()->route('dinas.verification.index')
            ->with('success', "UMKM {$user->name} ditolak verifikasinya.");
    }
}
