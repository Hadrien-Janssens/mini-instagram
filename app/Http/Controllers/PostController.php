<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $path = null;

        $validatePostData = $request->validated();

        if ($validatePostData) {
            $path = $request->file('img_path')->store('images', 'public');
        }

        Post::create([
            'title' => $request->input('title'),
            'img_path' => $path,
            'content' => $request->input('legende'),
            'user_id' => Auth::id(),
            'published_at' => Carbon::now()->timestamp
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {

        // Récupérer le post avec les likes et l'utilisateur
        $post = Post::with(['user', 'like'])->find($post->id);

        // Récupérer les commentaires avec pagination, tout en chargeant l'utilisateur de chaque commentaire
        $comments = $post->comments()->with('user')->paginate(2); // 10 commentaires par page

        // Vérifier si l'utilisateur suit l'auteur du post
        $userOfPost = $post->user;
        $post->is_followed = Auth::user()->followers->contains('followed_id', $userOfPost->id);

        // Vérifier si le post est liké par l'utilisateur connecté
        $post->is_liked = $post->like->contains('user_id', Auth::id());

        // Retourner la vue avec le post et les commentaires paginés
        return view('post.show', [
            'post' => $post,
            'comments' => $comments, // Ajouter les commentaires paginés ici
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        //pas oublier de valider

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
