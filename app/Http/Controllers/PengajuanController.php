<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
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
            // Use dummy user ID if not logged in properly with Auth::attempt yet based on project state
            'user_id' => Auth::check() ? Auth::id() : 1, 
            'program_name' => 'Pendampingan Akses Layanan Pembiayaan',
            'kebutuhan_usaha' => $request->kebutuhan_usaha,
            'dokumen_pendukung' => $dokumenPath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim.');
    }
}
