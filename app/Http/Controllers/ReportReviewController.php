<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportReviewController extends Controller
{
    public function index()
    {
        $reports = Report::with('user')->latest()->paginate(10);

        return view('dinas.report.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $report->load(['user', 'reviewer']);

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
