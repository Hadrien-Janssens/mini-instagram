<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $posts = Post::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('user.index', ['posts' => $posts]);
    }
}