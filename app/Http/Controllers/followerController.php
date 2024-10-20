<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FollowerController extends Controller
{
    public function index(): View
    {
        $followers = User::query()
            ->whereIn('id', Follower::query()->where('followed_id', Auth::id())->pluck('follower_id'))
            ->get();


        return view('follower.index', ['followers' => $followers]);
    }
}
