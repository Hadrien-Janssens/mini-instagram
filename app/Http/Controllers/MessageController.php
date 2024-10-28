<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function show(Conversation $conversation)
    {
        // $mes = new Message();
        // $mes->conversation_id = 1;
        // $mes->sender_id = 2;
        // $mes->receiver_id = Auth::id();
        // $mes->content = 'Salut 👋, oui et toi ? ';
        // $mes->save();

        $messages = $conversation->messages()->with('sender')->get();

        return view('messages.index', [
            'messages' => $messages
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'receiver_id' => 'required',
        ]);

        $conversation = Conversation::where('sender_id', Auth::id())
            ->where('receiver_id', $request->receiver_id)
            ->first();

        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->sender_id = Auth::id();
            $conversation->receiver_id = $request->receiver_id;
            $conversation->save();
        }

        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->receiver_id;
        $message->content = $request->content;
        $message->save();

        return back();
    }
}
