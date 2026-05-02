<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $request->validate([
            'kebutuhan_usaha' => 'required|string',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
        ]);

        $dokumenPath = null;
        if ($request->hasFile('dokumen_pendukung')) {
            $dokumenPath = $request->file('dokumen_pendukung')->store('dokumen_pengajuan', 'public');
        }

        Pengajuan::create([
            'user_id' => Auth::check() ? Auth::id() : 1,
            'program_name' => 'Pendampingan Akses Layanan Pembiayaan',
            'kebutuhan_usaha' => $request->kebutuhan_usaha,
            'dokumen_pendukung' => $dokumenPath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim.');
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
