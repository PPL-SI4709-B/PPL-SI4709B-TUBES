<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'active')
            ->orderBy('event_date')
            ->get();

        return view('umkm.event', compact('events'));
    }

    public function show(Event $event)
    {
        return view('umkm.eventdetail', compact('event'));
    }

    public function history()
    {
        $registrations = \App\Models\EventRegistration::with('event')
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('umkm.event_history', compact('registrations'));
    }
}
