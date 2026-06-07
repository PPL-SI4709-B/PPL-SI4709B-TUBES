<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'income' => 'required|numeric|min:0',
            'expense' => 'required|numeric|min:0',
            'catatan_usaha' => 'nullable|string',
            'report_date' => 'required|date',
            'period' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $profit = $validated['income'] - $validated['expense'];

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
            'status' => 'pending',
        ]);

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil diajukan.');
    }
}
