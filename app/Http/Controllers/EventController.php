<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // ===== UMKM-facing =====

    public function index(Request $request)
    {
        $search = $request->query('search');
        $type = $request->query('type');

        $events = Event::where('status', 'active')
            ->when($search, fn ($q) => $q->where('title', 'like', "%{$search}%"))
            ->when($type, fn ($q) => $q->where('type', $type))
            ->orderBy('event_date')
            ->get();

        $types = Event::where('status', 'active')->distinct()->orderBy('type')->pluck('type');

        $registeredEventIds = Auth::check()
            ? Auth::user()->registeredEvents()->pluck('events.id')->toArray()
            : [];

        return view('umkm.event', compact('events', 'registeredEventIds', 'types', 'search', 'type'));
    }

    public function show(Event $event)
    {
        return view('umkm.eventdetail', compact('event'));
    }

    public function history()
    {
        $registrations = EventRegistration::with('event')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('umkm.event_history', compact('registrations'));
    }

    // ===== Dinas event management (CRUD) =====

    public function adminIndex()
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'type' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'type' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
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
}
