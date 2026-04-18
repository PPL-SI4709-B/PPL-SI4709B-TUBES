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
        ]);

        Pengajuan::create([
            // Use dummy user ID if not logged in properly with Auth::attempt yet based on project state
            'user_id' => Auth::check() ? Auth::id() : 1, 
            'program_name' => 'Pendampingan Akses Layanan Pembiayaan',
            'kebutuhan_usaha' => $request->kebutuhan_usaha,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim.');
    }
}
