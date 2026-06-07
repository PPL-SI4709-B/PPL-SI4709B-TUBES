<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriEdukasi;
use Illuminate\Support\Facades\Storage;

class MateriEdukasiUmkmController extends Controller
{
    public function index()
    {
        $materi = MateriEdukasi::latest()->paginate(9);
        return view('umkm.materi-edukasi.index', compact('materi'));
    }

    public function show(MateriEdukasi $materiEdukasi)
    {
        return view('umkm.materi-edukasi.show', compact('materiEdukasi'));
    }

    public function download(MateriEdukasi $materiEdukasi)
    {
        if (!Storage::disk('public')->exists($materiEdukasi->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($materiEdukasi->file_path);
    }
}
