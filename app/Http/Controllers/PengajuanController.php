<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with(['user', 'program'])->latest()->paginate(10);

        return view('dinas.pengajuan.index', compact('pengajuans'));
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load(['user', 'program']);

        return view('dinas.pengajuan.show', compact('pengajuan'));
    }

    public function approve(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $pengajuan->update([
            'status' => 'approved',
            'notes'  => $request->notes,
        ]);

        return redirect()->route('dinas.pengajuan.index')
            ->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $pengajuan->update([
            'status' => 'rejected',
            'notes'  => $request->notes,
        ]);

        return redirect()->route('dinas.pengajuan.index')
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}
