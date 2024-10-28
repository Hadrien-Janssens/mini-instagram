<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function show(Conversation $conversation)
    {
        $messages = $conversation->messages()->with('sender')->with('receiver')->get();
        if ($conversation->receiver_id === Auth::id()) {
            $user = $conversation->sender()->first();
        } else {
            $user = $conversation->receiver()->first();
        }
        return view('messages.index', [
            'messages' => $messages,
            'user' => $user
        ]);
    }
    public function store(Request $request, User $user)
    {
        //récuperer les parametre de $request
        $request->validate([
            'content' => 'required'
        ]);
        $conversation = Conversation::where('receiver_id', Auth::id())->where('sender_id', $user->id)->first();

        if ($conversation === null) {
            $conversation = Conversation::where('sender_id', Auth::id())
                ->where('receiver_id', $user->id)->first();
        }
        // ici j'ai le choix entre réécrire le code de la creation d'une conversation ou envoyer vers le controller conversation.store, je sais pas c'est quoi le mieux ? dupliquer tu codes, ou ce balader d'un controller à l'autre (mais du coup ça prend plus de temps j'imagine ) ?

        //creer deux ??
        if ($conversation === null) {
            $conversation = new Conversation();
            $conversation->sender_id = Auth::id();
            $conversation->receiver_id = $user->id;
            $conversation->save();
        }
        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->sender_id = Auth::id();
        $message->receiver_id = $user->id;
        $message->content = $request->content;
        $message->save();

        Notification::create([
            'user_id' => $user->id,
            'content' => Auth::user()->name . ' t\'as envoyé un message',
            'link' => route('message.show', $conversation),
            'Make_by_user_id' => Auth::id()
        ]);

        return back();
    }
}
