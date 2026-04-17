<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        // Simple dummy authentication for UI prototyping flow
        // In a real scenario, use: Auth::attempt($request->only('email', 'password'))
        
        $email = $request->input('email');
        
        if ($email) {
            // Drop a dummy session to indicate logged in
            Session::put('is_logged_in', true);
            Session::put('user_email', $email);
            
            return redirect()->route('umkm.dashboard');
        }
        
        return back()->with('error', 'Kredensial tidak valid.');
    }

    public function processRegisterStep1(Request $request)
    {
        // Save step 1 data into session (simulated)
        return redirect()->route('umkm.register.step-2');
    }

    public function processRegisterStep2(Request $request)
    {
        // Save step 2 data into session (simulated)
        return redirect()->route('umkm.register.step-3');
    }

    public function processRegisterStep3(Request $request)
    {
        // Complete registration, log them in, then dashboard
        Session::put('is_logged_in', true);
        Session::put('user_email', 'newuser@umkm.local');
        
        return redirect()->route('umkm.dashboard')->with('success', 'Pendaftaran berhasil!');
    }
    
    public function logout(Request $request)
    {
        Session::forget('is_logged_in');
        Session::forget('user_email');
        return redirect()->route('login');
    }
}
