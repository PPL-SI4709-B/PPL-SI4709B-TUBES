<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('dinas.event.index', compact('events'));
    }

    public function create()
    {
        return view('dinas.event.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'quota'       => 'required|integer|min:1',
            'status'      => 'required|in:draft,published,completed',
        ]);

        Event::create($validated);

        return redirect()->route('dinas.event.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('dinas.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'quota'       => 'required|integer|min:1',
            'status'      => 'required|in:draft,published,completed',
        ]);

        $event->update($validated);

        return redirect()->route('dinas.event.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('dinas.event.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    public function umkmIndex()
    {
        // Dummy Auth Check
        if (!session()->has('is_logged_in')) {
            return redirect()->route('login');
        }

        $events = Event::whereIn('status', ['published', 'completed'])->latest()->get();
        
        // Get registered event IDs for dummy user
        $email = session()->get('user_email');
        $user = \App\Models\User::where('email', $email)->first();
        $registeredEventIds = $user ? $user->registeredEvents()->pluck('events.id')->toArray() : [];

        return view('umkm.event', compact('events', 'registeredEventIds'));
    }
}
