<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Region;
use App\Models\Scale;
use App\Models\UmkmProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    public function show()
    {
        $user    = Auth::user();
        $profile = $user->umkmProfile()->with(['category', 'region', 'scale'])->first();

        return view('umkm.profile.show', compact('user', 'profile'));
    }

    public function edit()
    {
        $user       = Auth::user();
        $profile    = $user->umkmProfile()->first();
        $categories = Category::orderBy('name')->get();
        $regions    = Region::orderBy('name')->get();
        $scales     = Scale::orderBy('name')->get();

        return view('umkm.profile.edit', compact('user', 'profile', 'categories', 'regions', 'scales'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'business_name'    => 'required|string|max:255',
            'phone'            => 'nullable|string|max:20',
            'nib'              => 'nullable|string|max:50',
            'business_address' => 'required|string',
            'category_id'      => 'required|exists:categories,id',
            'region_id'        => 'required|exists:regions,id',
            'scale_id'         => 'required|exists:scales,id',
        ]);

        $user = Auth::user();

        UmkmProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validated + ['user_id' => $user->id]
        );

        return redirect()->route('umkm.profile.show')
            ->with('success', 'Profil usaha berhasil diperbarui.');
    }
}
