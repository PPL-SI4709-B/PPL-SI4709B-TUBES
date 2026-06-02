<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\Report;
use App\Models\UmkmProfile;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function umkm()
    {
        $user = auth()->user();
        $profile = $user->umkmProfile()->with(['category', 'region', 'scale'])->first();

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

        $reportStatus = $user->reports()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $approvedPengajuan = $pengajuanStatus->get('approved', 0);
        $pendingPengajuan = $pengajuanStatus->get('pending', 0);
        $rejectedPengajuan = $pengajuanStatus->get('rejected', 0);
        $reviewedReports = $reportStatus->get('reviewed', 0);

        $profileFields = [
            $profile?->business_name,
            $profile?->phone,
            $profile?->nib,
            $profile?->business_address,
            $profile?->category_id,
            $profile?->region_id,
            $profile?->scale_id,
        ];
        $completedProfileFields = collect($profileFields)->filter(fn ($value) => filled($value))->count();
        $profileCompleteness = (int) round(($completedProfileFields / count($profileFields)) * 100);
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
            'totalPendanaan',
            'reportStatus'
        ));
    }

    public function dinas()
    {
        $totalUmkm       = User::where('role', 'umkm')->count();
        $verifiedUmkm    = User::where('role', 'umkm')->where('profile_status', 'verified')->count();
        $pendingUmkm     = User::where('role', 'umkm')->where('profile_status', 'pending')->count();
        $rejectedUmkm    = User::where('role', 'umkm')->where('profile_status', 'rejected')->count();
        $totalPengajuan  = Pengajuan::count();
        $pendingApproval = Pengajuan::where('status', 'pending')->count();
        $approvedPengajuan = Pengajuan::where('status', 'approved')->count();
        $rejectedPengajuan = Pengajuan::where('status', 'rejected')->count();
        $totalReports    = Report::count();
        $pendingReports  = Report::where('status', 'pending')->count();
        $reviewedReports = Report::where('status', 'reviewed')->count();

        $verificationRate = $totalUmkm > 0 ? round(($verifiedUmkm / $totalUmkm) * 100) : 0;
        $approvalRate = $totalPengajuan > 0 ? round(($approvedPengajuan / $totalPengajuan) * 100) : 0;
        $reportReviewRate = $totalReports > 0 ? round(($reviewedReports / $totalReports) * 100) : 0;

        $recentPengajuans = Pengajuan::with(['user', 'program'])
            ->latest()
            ->take(5)
            ->get();

        $recentReports = Report::with('user')
            ->latest()
            ->take(5)
            ->get();

        $topPrograms = Program::withCount('pengajuans')
            ->orderByDesc('pengajuans_count')
            ->take(4)
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
            'totalPengajuan',
            'pendingApproval',
            'approvedPengajuan',
            'rejectedPengajuan',
            'totalReports',
            'pendingReports',
            'reviewedReports',
            'verificationRate',
            'approvalRate',
            'reportReviewRate',
            'recentPengajuans',
            'recentReports',
            'topPrograms',
            'categoryDistribution'
        ));
    }

    public function exportUmkm(): StreamedResponse
    {
        $fileName = 'rekap-data-umkm-' . now()->format('Ymd-His') . '.csv';

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
