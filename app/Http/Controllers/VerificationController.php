<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        $pending = User::where('role', 'umkm')->where('profile_status', 'pending')->latest()->get();
        $verified = User::where('role', 'umkm')->where('profile_status', 'verified')->latest()->get();
        $rejected = User::where('role', 'umkm')->where('profile_status', 'rejected')->latest()->get();

        return view('dinas.verification.index', compact('pending', 'verified', 'rejected'));
    }

    public function verify(User $user)
    {
        if ($user->profile_status !== 'pending') {
            return redirect()->route('dinas.verification.index')
                ->with('error', 'UMKM ini sudah diproses.');
        }

        $user->update([
            'profile_status' => 'verified',
            'verification_note' => null,
        ]);

        return redirect()->route('dinas.verification.index')
            ->with('success', "UMKM {$user->name} berhasil diverifikasi.");
    }

    public function reject(Request $request, User $user)
    {
        if ($user->profile_status !== 'pending') {
            return redirect()->route('dinas.verification.index')
                ->with('error', 'UMKM ini sudah diproses.');
        }

        $validated = $request->validate([
            'verification_note' => 'nullable|string|max:1000',
        ]);

        $user->update([
            'profile_status' => 'rejected',
            'verification_note' => $validated['verification_note'] ?? null,
        ]);

        return redirect()->route('dinas.verification.index')
            ->with('success', "UMKM {$user->name} ditolak verifikasinya.");
    }
}
