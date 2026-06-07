<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('dinas.notifications.index', compact('notifications'));
    }

    public function umkmIndex()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        $pengajuans = Pengajuan::where('user_id', Auth::id())
            ->orderByDesc('updated_at')
            ->get();

        return view('umkm.notifications.index', compact('notifications', 'pengajuans'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id === Auth::id()) {
            $notification->update(['read_at' => now()]);
        }

        return back();
    }
}
