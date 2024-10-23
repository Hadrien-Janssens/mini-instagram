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
        $notifications = Notification::where('user_id', Auth::id())
            ->with('byUser')
            ->get();

        return view('notification.index', compact('notifications'));
    }

    public function destroy(Notification $notification) {}
}
