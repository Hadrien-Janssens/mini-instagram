<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class friendController extends Controller
{
    public function index(): View
    {

        $followeds = User::query()
            ->whereIn('id', Follower::query()->where('follower_id', Auth::id())->pluck('followed_id'))
            ->get();

        return view('friend.index', ['followeds' => $followeds]);
    }
}
