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

    public function approve(Pengajuan $pengajuan)
    {
        $pengajuan->update(['status' => 'approved']);

        return redirect()->route('dinas.pengajuan.index')
            ->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Pengajuan $pengajuan)
    {
        $pengajuan->update(['status' => 'rejected']);

        return redirect()->route('dinas.pengajuan.index')
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}
