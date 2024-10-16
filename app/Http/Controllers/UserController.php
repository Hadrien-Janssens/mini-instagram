<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(Request $request): View
    {
        if ($request->id == Auth::id()) {
            $user = Auth::user();
        } else {
            $user = User::findOrFail($request->id);
        }

        $posts = Post::where('user_id', '=', $request->id)->orderBy('created_at', 'desc')->get();
        return view('user.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
