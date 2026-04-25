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
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'status' => 'pending',
        ]);

        return redirect()->route('reports.index')
            ->with('success', 'Laporan berhasil diajukan.');
    }
}
