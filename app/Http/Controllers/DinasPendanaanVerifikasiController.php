<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPendanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DinasPendanaanVerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $allowedStatuses = [
            'diajukan',
            'menunggu_verifikasi',
            'diproses',
            'disetujui',
            'ditolak',
        ];
        $selectedStatus = $request->query('status');

        $pengajuans = PengajuanPendanaan::with([
            'user.umkmProfile.category',
            'user.umkmProfile.region',
            'user.umkmProfile.scale',
            'sumberPendanaan',
            'reviewer',
        ])
            ->when(in_array($selectedStatus, $allowedStatuses, true), function ($query) use ($selectedStatus) {
                $query->where('status', $selectedStatus);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dinas.pendanaan-verifikasi.index', compact(
            'pengajuans',
            'allowedStatuses',
            'selectedStatus'
        ));
    }

    public function show(PengajuanPendanaan $pengajuanPendanaan)
    {
        $pengajuanPendanaan->load([
            'user.umkmProfile.category',
            'user.umkmProfile.region',
            'user.umkmProfile.scale',
            'sumberPendanaan',
            'reviewer',
        ]);

        return view('dinas.pendanaan-verifikasi.show', compact('pengajuanPendanaan'));
    }

    public function approve(Request $request, PengajuanPendanaan $pengajuanPendanaan)
    {
        if ($pengajuanPendanaan->status !== 'diajukan') {
            return redirect()->back()
                ->with('error', 'Pengajuan pendanaan sudah diproses dan tidak dapat diproses ulang.');
        }

        $validated = $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        $pengajuanPendanaan->update([
            'status' => 'disetujui',
            'catatan' => $validated['catatan'] ?? null,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('dinas.pendanaan-verifikasi.show', $pengajuanPendanaan)
            ->with('success', 'Pengajuan pendanaan berhasil disetujui.');
    }

    public function reject(Request $request, PengajuanPendanaan $pengajuanPendanaan)
    {
        if ($pengajuanPendanaan->status !== 'diajukan') {
            return redirect()->back()
                ->with('error', 'Pengajuan pendanaan sudah diproses dan tidak dapat diproses ulang.');
        }

        $validated = $request->validate([
            'catatan' => 'required|string|max:1000',
        ], [
            'catatan.required' => 'Catatan wajib diisi ketika menolak pengajuan pendanaan.',
        ]);

        $pengajuanPendanaan->update([
            'status' => 'ditolak',
            'catatan' => $validated['catatan'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('dinas.pendanaan-verifikasi.show', $pengajuanPendanaan)
            ->with('success', 'Pengajuan pendanaan berhasil ditolak.');
    }
}
