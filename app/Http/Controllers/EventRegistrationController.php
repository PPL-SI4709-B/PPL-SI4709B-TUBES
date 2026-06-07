<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    /**
     * Register the authenticated UMKM user for an event.
     */
    public function register(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        // Quota check
        if ($event->registrants()->count() >= $event->quota) {
            return back()->with('error', 'Maaf, kuota untuk event ini sudah penuh.');
        }

        $user = Auth::user();

        // Already registered?
        if ($event->registrants()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Anda sudah terdaftar pada event ini.');
        }

        $event->registrants()->attach($user->id, [
            'status' => 'registered',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Berhasil mendaftar ke event: '.$event->title);
    }
}
