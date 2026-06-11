<?php

namespace App\Http\Controllers;

use App\Models\LaporanBerkala;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportReviewController extends Controller
{
    public function index()
    {
        $reports = LaporanBerkala::with(['user.umkmProfile'])
            ->where('status', 'submitted')
            ->latest()
            ->get();

        $umkmReports = $reports
            ->groupBy('user_id')
            ->map(function ($group) {
                $sortedReports = $group->sortByDesc('updated_at')->values();
                $latestReport = $sortedReports->first();

                return (object) [
                    'user' => $latestReport?->user,
                    'latestReport' => $latestReport,
                    'reports' => $sortedReports,
                    'reportsCount' => $sortedReports->count(),
                ];
            })
            ->sortByDesc(fn ($item) => $item->latestReport?->updated_at?->timestamp ?? 0)
            ->values();

        $totalReports = $reports->count();

        return view('dinas.report.index', compact('umkmReports', 'totalReports'));
    }

    public function showUmkm(User $user)
    {
        $user->load(['umkmProfile.category', 'umkmProfile.region', 'umkmProfile.scale']);

        $reports = LaporanBerkala::where('user_id', $user->id)
            ->where('status', 'submitted')
            ->orderByDesc('tahun')
            ->orderByDesc('kuartal')
            ->get();

        abort_if($reports->isEmpty(), 404);

        return view('dinas.report.umkm', compact('user', 'reports'));
    }

    public function show($report)
    {
        $report = LaporanBerkala::with([
            'user.umkmProfile.category',
            'user.umkmProfile.region',
            'user.umkmProfile.scale',
        ])
            ->where('status', 'submitted')
            ->findOrFail($report);

        return view('dinas.report.show', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        if ($report->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Laporan sudah direview dan tidak dapat direview ulang.');
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'catatan_petugas' => 'nullable|string|max:1000',
        ]);

        $report->update([
            'status' => $request->status,
            'catatan_petugas' => $request->catatan_petugas,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('dinas.report.index')
            ->with('success', 'Status laporan berhasil diperbarui.');
    }
}
