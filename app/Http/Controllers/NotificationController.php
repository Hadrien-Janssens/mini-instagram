<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mockery\Matcher\Not;

class NotificationController extends Controller
{
    public function index(): View
    {
        // mettre la notification en seen
        $notification_notSeen = Notification::where('seen', false)
            ->where('user_id', Auth::id());
        $notification_notSeen->update(['seen' => true]);


        $notifications = Notification::where('user_id', Auth::id())
            ->with('byUser')
            ->get();

        return view('notification.index', compact('notifications'));
    }

    public function destroy(Notification $notification) {}

    public function unreadCount()
    {

        if (Auth::check()) {
            $countNotificationsNotSeen = Notification::where('user_id', Auth::id())->where('seen', false)->count();
        }

        return response()->json(['countNotificationsNotSeen' => $countNotificationsNotSeen]);
    }
}
