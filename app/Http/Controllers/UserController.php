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
    public function index(Request $request): View
    {
        // Récupérer l'utilisateur visité
        $user = User::findOrFail($request->id);

        // Récupérer les posts de $user avec la vérification des likes intégrée
        $posts = Post::where('user_id', $user->id)  // Filtre pour les posts de cet utilisateur
            ->withCount(['like as is_liked' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->with(['comments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->when($request->query('search'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('content', 'like', '%' . $search . '%')
                        ->orWhere('title', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($posts as $post) {
            $post->likes_count = $post->like->count();
        }


        // Vérifier si l'utilisateur connecté suit l'utilisateur visité
        $is_followed = Follower::where('follower_id', Auth::id())
            ->where('followed_id', $user->id)
            ->exists();


        return view('user.index', [
            'user' => $user,
            'posts' => $posts,
            'is_followed' => $is_followed,
            'comments' => []
        ]);
    }
}
