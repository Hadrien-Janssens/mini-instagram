<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        // Récupérer les posts avec la vérification des likes et les auteurs des posts
        $followedUserPosts = Post::withCount(['like as is_liked' => function ($query) {
            $query->where('user_id', Auth::id());
        }])
            ->with('user') // Charger explicitement la relation 'user'
            ->whereHas('user.followed', function ($query) {
                $query->where('follower_id', Auth::id());
            })
            ->select('posts.*')
            ->join(DB::raw('(SELECT MAX(id) as latest_post_id FROM posts GROUP BY user_id) as latest_posts'), 'posts.id', '=', 'latest_posts.latest_post_id')
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


        $followedPostIds = $followedUserPosts->pluck('id')->toArray();

        $posts = Post::withCount(['like as is_liked' => function ($query) {
            $query->where('user_id', Auth::id());
        }])
            ->with('user') // Charger explicitement la relation 'user'
            ->whereNotIn('id', $followedPostIds)
            ->select('posts.*')
            ->selectRaw('(SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) as likes_count') // Compter les likes
            ->join(DB::raw('(SELECT MAX(id) as latest_post_id FROM posts GROUP BY user_id) as latest_posts'), 'posts.id', '=', 'latest_posts.latest_post_id')
            ->when($request->query('search'), function ($query, $search) {
                $query->where('content', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('likes_count', 'desc') // Trier par le nombre de likes
            ->orderBy('created_at', 'desc') // Ensuite trier par date de création
            ->get();


        $users = User::when($request->query('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();

        // Récupérer les IDs des utilisateurs suivis par l'utilisateur connecté
        $followedUserIds = Follower::where('follower_id', Auth::id())
            ->pluck('followed_id')
            ->toArray();

        // Boucle pour ajouter le champ is_followed
        foreach ($followedUserPosts as $post) {
            $post->is_liked = $post->like->contains('user_id', Auth::id());
            $post->likes_count = $post->like->count();
            $post->is_followed = in_array($post->user_id, $followedUserIds);
            $comments = $post->comments()->with('user')->paginate(2);
        }

        foreach ($posts as $post) {
            $post->is_liked = $post->like->contains('user_id', Auth::id());
            $post->is_followed = in_array($post->user_id, $followedUserIds);
            $comments = $post->comments()->with('user')->paginate(5);
            $post->likes_count = $post->like->count();
        }

        return view('home.index', [
            'followedUserPosts' => $followedUserPosts,
            'posts' => $posts,
            'users' => $users,
            'comments' => empty($comments) ? [] : $comments
        ]);
    }
}
