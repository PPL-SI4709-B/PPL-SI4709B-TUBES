<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventRegistrationController extends Controller
{
    /**
     * Register the authenticated UMKM user for an event.
     */
    public function register(Request $request, $eventId)
    {
        // Check dummy authentication
        if (!Session::has('is_logged_in')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar event.');
        }

        $event = Event::findOrFail($eventId);

        // Check if event is still open (quota check)
        $currentRegistrations = $event->registrants()->count();
        if ($currentRegistrations >= $event->quota) {
            return back()->with('error', 'Maaf, kuota untuk event ini sudah penuh.');
        }

        // Identify user from dummy session email
        $email = Session::get('user_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'Profil pengguna tidak ditemukan. Pastikan Anda sudah terdaftar.');
        }

        // Check if user is already registered for this event
        if ($event->registrants()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Anda sudah terdaftar pada event ini.');
        }

        // Register the user
        $event->registrants()->attach($user->id, [
            'status' => 'registered',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Berhasil mendaftar ke event: ' . $event->title);
    }
}
