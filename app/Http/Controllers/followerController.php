<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FollowerController extends Controller
{
    public function index(): View
    {
        // $followers = User::query()
        //     ->whereIn('id', Follower::query()->where('followed_id', Auth::id())->pluck('follower_id'))
        //     ->get();
        $userId = Auth::id();

        // Obtenir les followers
        $followers = User::query()
            ->whereIn('id', Follower::query()->where('followed_id', $userId)->pluck('follower_id'))
            ->get();

        // Pour chaque follower, vérifier si l'utilisateur authentifié les suit
        foreach ($followers as $follower) {
            $follower->is_followed_by_me = Follower::query()
                ->where('follower_id', $userId)
                ->where('followed_id', $follower->id)
                ->exists();
        }

        return view('follower.index', ['followers' => $followers]);
    }
}
