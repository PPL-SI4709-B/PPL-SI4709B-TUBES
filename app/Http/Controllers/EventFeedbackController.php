<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\EventFeedback;
use Illuminate\Support\Facades\Auth;

class EventFeedbackController extends Controller
{
    public function create(Event $event)
    {
        return view('umkm.event-feedback.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        EventFeedback::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('umkm.event.history')->with('success', 'Terima kasih atas feedback Anda!');
    }
}
