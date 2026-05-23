<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanBerkala;
use Illuminate\Support\Facades\Auth;

class LaporanBerkalaController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'umkm') abort(403);
        
        $laporans = LaporanBerkala::where('user_id', Auth::id())
            ->orderBy('tahun', 'desc')
            ->orderBy('kuartal', 'desc')
            ->get();
            
        $chartDataRaw = LaporanBerkala::where('user_id', Auth::id())
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
        if (Auth::user()->role !== 'umkm') abort(403);
        return view('umkm.laporan_berkala.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'umkm') abort(403);
        
        $request->validate([
            'tahun' => 'required|string|max:4',
            'kuartal' => 'required|in:Q1,Q2,Q3,Q4',
            'omzet' => 'required|numeric|min:0',
            'jumlah_karyawan' => 'required|integer|min:0',
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
        ]);

        return redirect()->route('umkm.laporan_berkala.index')->with('success', 'Laporan berhasil dikirim.');
    }
}
