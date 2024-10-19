<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(Request $request): View
    {
        $user = User::findOrFail($request->id);

        // Récupérer les posts avec la vérification des likes intégrée
        $posts = Post::withCount(['like as is_liked' => function ($query) {
            $query->where('user_id', Auth::id());
        }])
            ->where('user_id', $request->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Vérifier si l'utilisateur connecté suit l'utilisateur visité
        $is_followed = Follower::where('follower_id', Auth::id())
            ->where('followed_id', $user->id)
            ->exists();

        return view('user.index', [
            'user' => $user,
            'posts' => $posts,
            'is_followed' => $is_followed
        ]);
    }
}
