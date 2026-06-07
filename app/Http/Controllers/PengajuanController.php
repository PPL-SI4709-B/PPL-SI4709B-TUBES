<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with(['user', 'program'])->latest()->paginate(10);

        return view('dinas.pengajuan.index', compact('pengajuans'));
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load(['user', 'program', 'reviewer']);

        return view('dinas.pengajuan.show', compact('pengajuan'));
    }

    public function umkmIndex()
    {
        $programsPendanaan = Program::where('status', 'active')
            ->where('jenis', 'pendanaan')
            ->orderBy('name')
            ->get();

        $pengajuans = Pengajuan::with('program')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('umkm.pengajuan.index', compact(
            'pengajuans',
            'programsPendanaan'
        ));
    }

    public function store(Request $request)
    {
        if (Auth::user()->profile_status !== 'verified') {
            return redirect()->back()->with('error', 'Akun Anda belum diverifikasi. Tunggu petugas memverifikasi akun Anda.');
        }

        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'kebutuhan_usaha' => 'required|string',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
        ]);

        $program = Program::findOrFail($request->program_id);

        $dokumenPath = null;
        if ($request->hasFile('dokumen_pendukung')) {
            $dokumenPath = $request->file('dokumen_pendukung')->store('dokumen_pengajuan', 'local');
        }

        Pengajuan::create([
            'user_id' => Auth::id(),
            'program_id' => $request->program_id,
            'jenis' => $program->jenis,
            'kebutuhan_usaha' => $request->kebutuhan_usaha,
            'dokumen_pendukung' => $dokumenPath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function approve(Request $request, Pengajuan $pengajuan)
    {
        if ($pengajuan->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Pengajuan sudah diproses dan tidak dapat diproses ulang.');
        }

        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $pengajuan->update([
            'status' => 'approved',
            'notes' => $request->notes,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('dinas.pengajuan.index')
            ->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Request $request, Pengajuan $pengajuan)
    {
        if ($pengajuan->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Pengajuan sudah diproses dan tidak dapat diproses ulang.');
        }

        $request->validate([
            'notes' => 'required|string|max:1000',
        ], [
            'notes.required' => 'Catatan wajib diisi ketika menolak pengajuan.',
        ]);

        $pengajuan->update([
            'status' => 'rejected',
            'notes' => $request->notes,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('dinas.pengajuan.index')
            ->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function dokumen(Pengajuan $pengajuan)
    {
        $user = Auth::user();
        if ($user->role !== 'dinas' && $pengajuan->user_id !== $user->id) {
            abort(403);
        }

        if (! $pengajuan->dokumen_pendukung || ! Storage::disk('local')->exists($pengajuan->dokumen_pendukung)) {
            abort(404);
        }

        return Storage::disk('local')->response($pengajuan->dokumen_pendukung);
    }
}
