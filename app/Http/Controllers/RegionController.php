<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of regions.
     */
    public function index()
    {
        $regions = Region::latest()->paginate(10);

        return view('dinas.region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new region.
     */
    public function create()
    {
        return view('dinas.region.create');
    }

    /**
     * Store a newly created region.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:regions,name',
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama wilayah wajib diisi.',
            'name.unique' => 'Nama wilayah sudah ada.',
            'name.max' => 'Nama wilayah maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        Region::create($request->only('name', 'description'));

        return redirect()->route('dinas.master-data')
            ->with('success', 'Wilayah berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a region.
     */
    public function edit(Region $region)
    {
        return view('dinas.region.edit', compact('region'));
    }

    /**
     * Update the specified region.
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:regions,name,'.$region->id,
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama wilayah wajib diisi.',
            'name.unique' => 'Nama wilayah sudah ada.',
            'name.max' => 'Nama wilayah maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        $region->update($request->only('name', 'description'));

        return redirect()->route('dinas.master-data')
            ->with('success', 'Wilayah berhasil diperbarui.');
    }

    /**
     * Remove the specified region.
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('dinas.master-data')
            ->with('success', 'Wilayah berhasil dihapus.');
    }
}
