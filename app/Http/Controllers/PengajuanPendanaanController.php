<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPendanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanPendanaanController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanPendanaan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('umkm.pendanaan.index', compact('pengajuans'));
    }

    public function create()
    {
        if (Auth::user()->profile_status !== 'verified') {
            return redirect()->route('umkm.pendanaan.index')
                ->with('error', 'Akun Anda belum diverifikasi. Tunggu petugas memverifikasi akun Anda sebelum mengajukan pendanaan.');
        }

        return view('umkm.pendanaan.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->profile_status !== 'verified') {
            return redirect()->back()
                ->with('error', 'Akun Anda belum diverifikasi. Tunggu petugas memverifikasi akun Anda.');
        }

        $request->validate([
            'jumlah_pengajuan'    => 'required|numeric|min:100000',
            'tujuan_pendanaan'    => 'required|string|max:255',
            'deskripsi_kebutuhan' => 'required|string|min:30',
            'dokumen_pendukung'   => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
        ], [
            'jumlah_pengajuan.required' => 'Jumlah pengajuan wajib diisi.',
            'jumlah_pengajuan.min'      => 'Jumlah pengajuan minimal Rp 100.000.',
            'tujuan_pendanaan.required' => 'Tujuan pendanaan wajib diisi.',
            'deskripsi_kebutuhan.required' => 'Deskripsi kebutuhan wajib diisi.',
            'deskripsi_kebutuhan.min'   => 'Deskripsi kebutuhan minimal 30 karakter.',
            'dokumen_pendukung.mimes'   => 'Dokumen harus berformat PDF, PNG, JPG, atau JPEG.',
            'dokumen_pendukung.max'     => 'Ukuran dokumen maksimal 2MB.',
        ]);

        $dokumenPath = null;
        if ($request->hasFile('dokumen_pendukung')) {
            $dokumenPath = $request->file('dokumen_pendukung')->store('dokumen_pendanaan', 'public');
        }

        $pengajuan = PengajuanPendanaan::create([
            'user_id'             => Auth::id(),
            'jumlah_pengajuan'    => $request->jumlah_pengajuan,
            'tujuan_pendanaan'    => $request->tujuan_pendanaan,
            'deskripsi_kebutuhan' => $request->deskripsi_kebutuhan,
            'dokumen_pendukung'   => $dokumenPath,
            'status'              => 'diajukan',
            'submitted_at'        => now(),
        ]);

        return redirect()->route('umkm.pendanaan.show', $pengajuan)
            ->with('success', 'Pengajuan pendanaan berhasil dikirim.');
    }

    public function show(PengajuanPendanaan $pengajuanPendanaan)
    {
        if ($pengajuanPendanaan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('umkm.pendanaan.show', compact('pengajuanPendanaan'));
    }
}
