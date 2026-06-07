<?php

namespace App\Http\Controllers;

use App\Models\LaporanBerkala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanBerkalaController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'umkm') {
            abort(403);
        }

        $laporans = LaporanBerkala::where('user_id', Auth::id())
            ->orderBy('tahun', 'desc')
            ->orderBy('kuartal', 'desc')
            ->get();

        $chartDataRaw = LaporanBerkala::where('user_id', Auth::id())
            ->where('status', 'submitted')
            ->orderBy('tahun', 'asc')
            ->orderBy('kuartal', 'asc')
            ->get();

        $chartLabels = [];
        $chartData = [];
        foreach ($chartDataRaw as $laporan) {
            $chartLabels[] = "{$laporan->kuartal} {$laporan->tahun}";
            $chartData[] = $laporan->omzet;
        }

        return view('umkm.laporan_berkala.index', compact('laporans', 'chartLabels', 'chartData'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'umkm') {
            abort(403);
        }

        return view('umkm.laporan_berkala.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'umkm') {
            abort(403);
        }

        $isDraft = $request->input('action') === 'draft';

        $request->validate([
            'tahun' => 'required|string|max:4',
            'kuartal' => 'required|in:Q1,Q2,Q3,Q4',
            'omzet' => $isDraft ? 'nullable|numeric|min:0' : 'required|numeric|min:0',
            'jumlah_karyawan' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
            'kendala' => 'nullable|string',
            'strategi_kedepan' => 'nullable|string',
        ]);

        LaporanBerkala::create([
            'user_id' => Auth::id(),
            'tahun' => $request->tahun,
            'kuartal' => $request->kuartal,
            'omzet' => $request->omzet,
            'jumlah_karyawan' => $request->jumlah_karyawan,
            'kendala' => $request->kendala,
            'strategi_kedepan' => $request->strategi_kedepan,
            'status' => $isDraft ? 'draft' : 'submitted',
        ]);

        $message = $isDraft ? 'Laporan berhasil disimpan sebagai draft.' : 'Laporan berhasil dikirim.';

        return redirect()->route('umkm.laporan_berkala.index')->with('success', $message);
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'umkm') {
            abort(403);
        }
        $laporan = LaporanBerkala::findOrFail($id);
        if ($laporan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('umkm.laporan_berkala.create', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'umkm') {
            abort(403);
        }
        $laporan = LaporanBerkala::findOrFail($id);
        if ($laporan->user_id !== Auth::id()) {
            abort(403);
        }

        $isDraft = $request->input('action') === 'draft';

        $request->validate([
            'tahun' => 'required|string|max:4',
            'kuartal' => 'required|in:Q1,Q2,Q3,Q4',
            'omzet' => $isDraft ? 'nullable|numeric|min:0' : 'required|numeric|min:0',
            'jumlah_karyawan' => $isDraft ? 'nullable|integer|min:0' : 'required|integer|min:0',
            'kendala' => 'nullable|string',
            'strategi_kedepan' => 'nullable|string',
        ]);

        $laporan->update([
            'tahun' => $request->tahun,
            'kuartal' => $request->kuartal,
            'omzet' => $request->omzet,
            'jumlah_karyawan' => $request->jumlah_karyawan,
            'kendala' => $request->kendala,
            'strategi_kedepan' => $request->strategi_kedepan,
            'status' => $isDraft ? 'draft' : 'submitted',
        ]);

        $message = $isDraft ? 'Draft laporan berhasil diperbarui.' : 'Laporan berhasil dikirim.';

        return redirect()->route('umkm.laporan_berkala.index')->with('success', $message);
    }
}
