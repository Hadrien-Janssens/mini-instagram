<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

class LikeController extends Controller
{
    public function index(Post $post): RedirectResponse | string
    {
        $like = Like::query()->where('post_id', $post->id)->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);

            Notification::create([
                'user_id' => $post->user_id,
                'content' => 'Ta publication ' . $post->title . ' a été likée par  ' . Auth::user()->name,
                'link' => route('post.show', $post),
                'Make_by_user_id' => Auth::id()
            ]);
        }

        return back();
    }
}
