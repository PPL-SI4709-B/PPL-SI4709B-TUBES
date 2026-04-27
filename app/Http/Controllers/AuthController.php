<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'dinas') {
                return redirect()->route('dinas.dashboard');
            }
            return redirect()->route('umkm.dashboard');
        }
        
        return back()->with('error', 'Kredensial tidak valid.');
    }

    public function processRegisterStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string',
            'password' => 'required|min:8|confirmed'
        ]);
        Session::put('register_step1', $validated);
        return redirect()->route('umkm.register.step-2');
    }

    public function processRegisterStep2(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_sector' => 'required|string',
            'business_address' => 'required|string',
            'nib' => 'nullable|string',
            'revenue' => 'required|string'
        ]);
        Session::put('register_step2', $validated);
        return redirect()->route('umkm.register.step-3');
    }

    public function processRegisterStep3(Request $request)
    {
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
        
        return redirect()->route('umkm.dashboard')->with('success', 'Pendaftaran berhasil!');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
