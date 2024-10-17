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

        // USER IS FOLLOWED BY AUTH ?
        // get all followed membre
        $followeds = User::query()
            ->whereIn('id', Follower::query()->where('follower_id', Auth::id())->pluck('followed_id'))
            ->get();

        // user include followeds ?
        $is_followed = false;
        foreach ($followeds as  $followed) {
            if ($followed->id === $user->id) {
                $is_followed = true;
            }
        }

        $posts = Post::where('user_id', '=', $request->id)->orderBy('created_at', 'desc')->get();
        return view('user.index', [
            'user' => $user,
            'posts' => $posts,
            'is_followed' => $is_followed
        ]);
    }
}
