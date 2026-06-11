<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPendanaan;
use App\Models\Event;
use App\Models\LaporanBerkala;
use App\Models\SumberPendanaan;
use App\Models\UmkmProfile;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function umkm()
    {
        $user = auth()->user();
        $profile = $user->umkmProfile()->with(['category', 'region', 'scale'])->first();

        $totalPengajuan = $user->pengajuans()->count();
        $totalLaporan = $user->reports()->count();
        $pengajuanStatus = $user->pengajuans()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $pendingPengajuan = (int) ($pengajuanStatus['pending'] ?? 0);
        $approvedPengajuan = (int) ($pengajuanStatus['approved'] ?? 0);
        $rejectedPengajuan = (int) ($pengajuanStatus['rejected'] ?? 0);
        $reviewedReports = $user->reports()->where('status', 'reviewed')->count();

        $profileFields = ['business_name', 'phone', 'nib', 'business_address', 'category_id', 'region_id', 'scale_id'];
        $profileCompleteness = $profile
            ? (int) round(collect($profileFields)->filter(fn ($field) => filled($profile->{$field}))->count() / count($profileFields) * 100)
            : 0;

        $recentPengajuans = $user->pengajuans()
            ->with('program')
            ->latest()
            ->take(5)
            ->get();

        $recentReports = $user->reports()
            ->latest()
            ->take(3)
            ->get();

        $totalPendanaan = $user->pengajuanPendanaans()->count();

        return view('umkm.dashboard', compact(
            'profile',
            'profileCompleteness',
            'totalPengajuan',
            'totalLaporan',
            'pengajuanStatus',
            'pendingPengajuan',
            'approvedPengajuan',
            'rejectedPengajuan',
            'reviewedReports',
            'recentPengajuans',
            'recentReports',
            'totalPendanaan'
        ));
    }

    public function dinas()
    {
        $totalUmkm = User::where('role', 'umkm')->count();
        $verifiedUmkm = User::where('role', 'umkm')->where('profile_status', 'verified')->count();
        $pendingUmkm = User::where('role', 'umkm')->where('profile_status', 'pending')->count();
        $rejectedUmkm = User::where('role', 'umkm')->where('profile_status', 'rejected')->count();
        $totalReports = LaporanBerkala::where('status', 'submitted')->count();
        $pendingReports = $totalReports;
        $reviewedReports = 0;
        $totalPendanaan = PengajuanPendanaan::count();
        $pendingPendanaan = PengajuanPendanaan::whereIn('status', ['diajukan', 'menunggu_verifikasi', 'diproses'])->count();
        $approvedPendanaan = PengajuanPendanaan::where('status', 'disetujui')->count();
        $rejectedPendanaan = PengajuanPendanaan::where('status', 'ditolak')->count();
        $totalEvents = Event::count();
        $totalEventRegistrations = Event::query()
            ->withCount('registrants')
            ->get()
            ->sum('registrants_count');
        $totalSumberPendanaan = SumberPendanaan::count();

        $verificationRate = $totalUmkm > 0 ? round(($verifiedUmkm / $totalUmkm) * 100) : 0;
        $reportReviewRate = 0;

        $recentReports = LaporanBerkala::with(['user.umkmProfile'])
            ->where('status', 'submitted')
            ->latest()
            ->take(5)
            ->get();

        $categoryDistribution = UmkmProfile::with('category')
            ->get()
            ->groupBy(fn (UmkmProfile $profile) => $profile->category?->name ?? 'Belum dikategorikan')
            ->map->count()
            ->sortDesc()
            ->take(5);

        return view('dinas.dashboard', compact(
            'totalUmkm',
            'verifiedUmkm',
            'pendingUmkm',
            'rejectedUmkm',
            'totalReports',
            'pendingReports',
            'reviewedReports',
            'totalPendanaan',
            'pendingPendanaan',
            'approvedPendanaan',
            'rejectedPendanaan',
            'totalEvents',
            'totalEventRegistrations',
            'totalSumberPendanaan',
            'verificationRate',
            'reportReviewRate',
            'recentReports',
            'categoryDistribution'
        ));
    }

    public function exportUmkm(): StreamedResponse
    {
        $fileName = 'rekap-data-umkm-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Nama Pemilik',
                'Email',
                'Status Profil',
                'Nama Usaha',
                'No HP',
                'NIB',
                'Kategori',
                'Wilayah',
                'Skala',
                'Total Pengajuan',
                'Total Laporan',
                'Tanggal Registrasi',
            ]);

            User::where('role', 'umkm')
                ->with(['umkmProfile.category', 'umkmProfile.region', 'umkmProfile.scale'])
                ->withCount(['pengajuans', 'reports'])
                ->orderBy('name')
                ->chunk(100, function ($users) use ($handle) {
                    foreach ($users as $user) {
                        fputcsv($handle, [
                            $user->name,
                            $user->email,
                            $user->profile_status,
                            $user->umkmProfile?->business_name,
                            $user->umkmProfile?->phone,
                            $user->umkmProfile?->nib,
                            $user->umkmProfile?->category?->name,
                            $user->umkmProfile?->region?->name,
                            $user->umkmProfile?->scale?->name,
                            $user->pengajuans_count,
                            $user->reports_count,
                            $user->created_at?->format('Y-m-d'),
                        ]);
                    }
                });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
