<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->latest()->get();

        return view('umkm.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('umkm.reports.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->profile_status !== 'verified') {
            return redirect()->back()
                ->with('error', 'Akun Anda belum diverifikasi. Tunggu petugas memverifikasi akun Anda sebelum membuat laporan.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'income' => 'required|numeric|min:0',
            'expense' => 'required|numeric|min:0',
            'catatan_usaha' => 'nullable|string',
            'report_date' => 'required|date',
            'period' => 'required|string',
            'due_date' => 'required|date',
            'lampiran' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
        ]);

        $profit = $validated['income'] - $validated['expense'];

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('laporan', 'local');
        }

        Report::create([
            'user_id' => Auth::id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'income' => $validated['income'],
            'expense' => $validated['expense'],
            'profit' => $profit,
            'catatan_usaha' => $validated['catatan_usaha'] ?? null,
            'report_date' => $validated['report_date'],
            'period' => $validated['period'],
            'due_date' => $validated['due_date'],
            'lampiran' => $lampiranPath,
            'status' => 'pending',
        ]);

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil diajukan.');
    }

    public function lampiran(Report $report)
    {
        $user = Auth::user();
        if ($user->role !== 'dinas' && $report->user_id !== $user->id) {
            abort(403);
        }

        if (! $report->lampiran || ! Storage::disk('local')->exists($report->lampiran)) {
            abort(404);
        }

        return Storage::disk('local')->response($report->lampiran);
    }
}
