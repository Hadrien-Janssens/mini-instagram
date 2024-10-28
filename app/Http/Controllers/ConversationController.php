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
        //check if conversation already existe
        $conversation = Conversation::where('receiver_id', Auth::id())->where('sender_id', $user->id)->first();

        if ($conversation === null) {
            $conversation = Conversation::where('sender_id', Auth::id())
                ->where('receiver_id', $user->id)->first();
        }
        if ($conversation === null) {
            // create conversation
            $conversation = new Conversation();
            $conversation->sender_id = Auth::id();
            $conversation->receiver_id = $user->id;
            $conversation->save();
        }

        // go to message page
        return redirect()->route('message.show', $conversation);
    }
}
