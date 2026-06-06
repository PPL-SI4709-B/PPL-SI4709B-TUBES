<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
>>>>>>> a15cbf70f39e9d2664e573b01c406838ba06c190

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
<<<<<<< HEAD
        // Simple dummy authentication for UI prototyping flow
        // In a real scenario, use: Auth::attempt($request->only('email', 'password'))
        
        $email = $request->input('email');
        
        if ($email) {
            // Drop a dummy session to indicate logged in
            Session::put('is_logged_in', true);
            Session::put('user_email', $email);
            
=======
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'dinas') {
                return redirect()->route('dinas.dashboard');
            }
>>>>>>> a15cbf70f39e9d2664e573b01c406838ba06c190
            return redirect()->route('umkm.dashboard');
        }
        
        return back()->with('error', 'Kredensial tidak valid.');
    }

    public function processRegisterStep1(Request $request)
    {
<<<<<<< HEAD
        // Save step 1 data into session (simulated)
=======
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string',
            'password' => 'required|min:8|confirmed'
        ]);
        Session::put('register_step1', $validated);
>>>>>>> a15cbf70f39e9d2664e573b01c406838ba06c190
        return redirect()->route('umkm.register.step-2');
    }

    public function processRegisterStep2(Request $request)
    {
<<<<<<< HEAD
        // Save step 2 data into session (simulated)
=======
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_sector' => 'required|string',
            'business_address' => 'required|string',
            'nib' => 'nullable|string',
            'revenue' => 'required|string'
        ]);
        Session::put('register_step2', $validated);
>>>>>>> a15cbf70f39e9d2664e573b01c406838ba06c190
        return redirect()->route('umkm.register.step-3');
    }

    public function processRegisterStep3(Request $request)
    {
<<<<<<< HEAD
        // Complete registration, log them in, then dashboard
        Session::put('is_logged_in', true);
        Session::put('user_email', 'newuser@umkm.local');
=======
        $request->validate([
            'assurance' => 'required|accepted'
        ]);

        $step1 = Session::get('register_step1');
        
        if (!$step1) {
            return redirect()->route('umkm.register.step-1')->with('error', 'Silakan isi data diri terlebih dahulu.');
        }

        $user = User::create([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password' => Hash::make($step1['password']),
            'role' => 'umkm'
        ]);
        
        Auth::login($user);
        
        Session::forget('register_step1');
        Session::forget('register_step2');
>>>>>>> a15cbf70f39e9d2664e573b01c406838ba06c190
        
        return redirect()->route('umkm.dashboard')->with('success', 'Pendaftaran berhasil!');
    }
    
    public function logout(Request $request)
    {
<<<<<<< HEAD
        Session::forget('is_logged_in');
        Session::forget('user_email');
=======
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
>>>>>>> a15cbf70f39e9d2664e573b01c406838ba06c190
        return redirect()->route('login');
    }
}
