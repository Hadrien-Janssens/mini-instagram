<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {


        // Récupérer les posts avec la vérification des likes et les auteurs des posts
        $posts = Post::withCount(['like as is_liked' => function ($query) {
            $query->where('user_id', Auth::id());
        }])
            ->with('user') // Charger explicitement la relation 'user'
            ->when($request->query('search'), function ($query, $search) {
                $query->where('content', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::when($request->query('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();

        // Récupérer les IDs des utilisateurs suivis par l'utilisateur connecté
        $followedUserIds = Follower::where('follower_id', Auth::id())
            ->pluck('followed_id')
            ->toArray();

        // Boucle pour ajouter le champ is_followed
        foreach ($posts as $post) {
            $post->is_followed = in_array($post->user_id, $followedUserIds);
            $comments = $post->comments()->with('user')->paginate(2);
        }

        return view('home.index', [
            'posts' => $posts,
            'users' => $users,
            'comments' => empty($comments) ? [] : $comments
        ]);
    }
}
