<?php

namespace App\Http\Controllers;

use App\Models\MateriEdukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriEdukasiDinasController extends Controller
{
    public function index()
    {
        $materi = MateriEdukasi::latest()->paginate(10);

        return view('dinas.materi-edukasi.index', compact('materi'));
    }

    public function create()
    {
        return view('dinas.materi-edukasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,zip|max:20480',
        ], [
            'title.required' => 'Judul materi wajib diisi.',
            'file.required' => 'File materi wajib diunggah.',
            'file.mimes' => 'Format file harus PDF, Office, gambar, atau ZIP.',
            'file.max' => 'Ukuran file maksimal 20 MB.',
        ]);

        $path = $request->file('file')->store('materi-edukasi', 'public');

        MateriEdukasi::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
        ]);

        return redirect()->route('dinas.materi-edukasi.index')
            ->with('success', 'Materi edukasi berhasil ditambahkan.');
    }

    public function download(MateriEdukasi $materiEdukasi)
    {
        if (! Storage::disk('public')->exists($materiEdukasi->file_path)) {
            return back()->with('error', 'File materi tidak ditemukan.');
        }

        return Storage::disk('public')->download($materiEdukasi->file_path);
    }
}
