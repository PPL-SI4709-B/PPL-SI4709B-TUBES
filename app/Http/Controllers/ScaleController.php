<?php

namespace App\Http\Controllers;

use App\Models\Scale;
use Illuminate\Http\Request;

class ScaleController extends Controller
{
    /**
     * Display a listing of scales.
     */
    public function index()
    {
        $scales = Scale::latest()->paginate(10);

        return view('dinas.scale.index', compact('scales'));
    }

    /**
     * Show the form for creating a new scale.
     */
    public function create()
    {
        return view('dinas.scale.create');
    }

    /**
     * Store a newly created scale.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:scales,name',
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama skala usaha wajib diisi.',
            'name.unique' => 'Nama skala usaha sudah ada.',
            'name.max' => 'Nama skala usaha maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        Scale::create($request->only('name', 'description'));

        return redirect()->route('dinas.master-data')
            ->with('success', 'Skala usaha berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a scale.
     */
    public function edit(Scale $scale)
    {
        return view('dinas.scale.edit', compact('scale'));
    }

    /**
     * Update the specified scale.
     */
    public function update(Request $request, Scale $scale)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:scales,name,'.$scale->id,
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama skala usaha wajib diisi.',
            'name.unique' => 'Nama skala usaha sudah ada.',
            'name.max' => 'Nama skala usaha maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        $scale->update($request->only('name', 'description'));

        return redirect()->route('dinas.master-data')
            ->with('success', 'Skala usaha berhasil diperbarui.');
    }

    /**
     * Remove the specified scale.
     */
    public function destroy(Scale $scale)
    {
        $scale->delete();

        return redirect()->route('dinas.master-data')
            ->with('success', 'Skala usaha berhasil dihapus.');
    }
}
