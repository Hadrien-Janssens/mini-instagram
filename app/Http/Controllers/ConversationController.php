<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConversationController extends Controller
{
    public function index(): View
    {
        $conversations = Conversation::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with('messages', 'sender', 'receiver')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('conversations.index', [
            'conversations' => $conversations
        ]);
    }
}
