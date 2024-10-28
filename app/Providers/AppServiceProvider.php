<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $users = User::all();
        View::share('users', $users);

        // $nofications_notSeen = Notification::where('user_id', Auth::id())->get();
        // View::share('nofications_notSeen', $nofications_notSeen);
    }
}