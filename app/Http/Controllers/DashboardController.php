<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Report;
use App\Models\User;

class DashboardController extends Controller
{
    public function umkm()
    {
        $user = auth()->user();

        $totalPengajuan  = $user->pengajuans()->count();
        $totalLaporan    = $user->reports()->count();
        $pengajuanStatus = $user->pengajuans()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $recentPengajuans = $user->pengajuans()
            ->with('program')
            ->latest()
            ->take(5)
            ->get();

        $recentReports = $user->reports()
            ->latest()
            ->take(3)
            ->get();

        return view('umkm.dashboard', compact(
            'totalPengajuan',
            'totalLaporan',
            'pengajuanStatus',
            'recentPengajuans',
            'recentReports'
        ));
    }

    public function dinas()
    {
        $totalUmkm      = User::where('role', 'umkm')->count();
        $verifiedUmkm   = User::where('role', 'umkm')->where('profile_status', 'verified')->count();
        $pendingUmkm    = User::where('role', 'umkm')->where('profile_status', 'pending')->count();
        $totalPengajuan = Pengajuan::count();
        $pendingApproval = Pengajuan::where('status', 'pending')->count();

        $recentPengajuans = Pengajuan::with(['user', 'program'])
            ->latest()
            ->take(5)
            ->get();

        return view('dinas.dashboard', compact(
            'totalUmkm',
            'verifiedUmkm',
            'pendingUmkm',
            'totalPengajuan',
            'pendingApproval',
            'recentPengajuans'
        ));
    }
}
