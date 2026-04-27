<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        return view('dinas.verification.index');
    }

    public function verify(Request $request, $id)
    {
        return redirect()->back()->with('success', 'UMKM verified successfully.');
    }

    public function reject(Request $request, $id)
    {
        return redirect()->back()->with('success', 'UMKM rejected.');
    }
}
