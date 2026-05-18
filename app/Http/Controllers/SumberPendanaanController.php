<?php

namespace App\Http\Controllers;

use App\Models\SumberPendanaan;
use Illuminate\Http\Request;

class SumberPendanaanController extends Controller
{
    /**
     * Display a listing of sumber pendanaan.
     */
    public function index()
    {
        $sumberPendanaans = SumberPendanaan::latest()->paginate(10);

        return view('dinas.sumber-pendanaan.index', compact('sumberPendanaans'));
    }

    /**
     * Show the form for creating a new sumber pendanaan.
     */
    public function create()
    {
        return view('dinas.sumber-pendanaan.create');
    }

    /**
     * Store a newly created sumber pendanaan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program'    => 'required|string|max:255',
            'mitra_penyalur'  => 'required|string|max:255',
            'batas_maksimal'  => 'required|numeric|min:1|max:6000000',
            'deskripsi'       => 'nullable|string',
            'persyaratan'     => 'nullable|string',
            'status'          => 'required|in:aktif,nonaktif',
        ], [
            'nama_program.required'   => 'Nama program wajib diisi.',
            'mitra_penyalur.required' => 'Mitra penyalur wajib diisi.',
            'batas_maksimal.required' => 'Batas maksimal wajib diisi.',
            'batas_maksimal.min'      => 'Batas maksimal minimal Rp 1.',
            'batas_maksimal.max'      => 'Batas maksimal tidak boleh melebihi Rp 6.000.000.',
            'status.required'         => 'Status wajib dipilih.',
            'status.in'               => 'Status harus aktif atau nonaktif.',
        ]);

        SumberPendanaan::create($validated);

        return redirect()->route('dinas.sumber-pendanaan.index')
            ->with('success', 'Sumber pendanaan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified sumber pendanaan.
     */
    public function edit(SumberPendanaan $sumberPendanaan)
    {
        return view('dinas.sumber-pendanaan.edit', compact('sumberPendanaan'));
    }

    /**
     * Update the specified sumber pendanaan.
     */
    public function update(Request $request, SumberPendanaan $sumberPendanaan)
    {
        $validated = $request->validate([
            'nama_program'    => 'required|string|max:255',
            'mitra_penyalur'  => 'required|string|max:255',
            'batas_maksimal'  => 'required|numeric|min:1|max:6000000',
            'deskripsi'       => 'nullable|string',
            'persyaratan'     => 'nullable|string',
            'status'          => 'required|in:aktif,nonaktif',
        ], [
            'nama_program.required'   => 'Nama program wajib diisi.',
            'mitra_penyalur.required' => 'Mitra penyalur wajib diisi.',
            'batas_maksimal.required' => 'Batas maksimal wajib diisi.',
            'batas_maksimal.min'      => 'Batas maksimal minimal Rp 1.',
            'batas_maksimal.max'      => 'Batas maksimal tidak boleh melebihi Rp 6.000.000.',
            'status.required'         => 'Status wajib dipilih.',
            'status.in'               => 'Status harus aktif atau nonaktif.',
        ]);

        $sumberPendanaan->update($validated);

        return redirect()->route('dinas.sumber-pendanaan.index')
            ->with('success', 'Sumber pendanaan berhasil diperbarui.');
    }

    /**
     * Remove the specified sumber pendanaan.
     */
    public function destroy(SumberPendanaan $sumberPendanaan)
    {
        $sumberPendanaan->delete();

        return redirect()->route('dinas.sumber-pendanaan.index')
            ->with('success', 'Sumber pendanaan berhasil dihapus.');
    }
}
