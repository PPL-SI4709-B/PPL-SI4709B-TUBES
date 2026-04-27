<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Dummy Auth Check
        if (!session()->has('is_logged_in')) {
            return redirect()->route('login');
        }

        return view('umkm.event');
    }
}
