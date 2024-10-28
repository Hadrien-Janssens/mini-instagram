<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
    public function create(User $user): RedirectResponse
    {
        // create conversation
        $conversations = new Conversation();
        $conversations->sender_id = Auth::id();
        $conversations->receiver_id = $user->id;
        $conversations->save();

        // go to message page
        return redirect()->route('message.show', $conversations);
    }
}
