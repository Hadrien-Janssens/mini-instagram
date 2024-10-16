<?php

use App\Http\Controllers\followerController;
use App\Http\Controllers\friendController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    $user =  Auth::user();
    if ($user->role === "admin") {
        return view('dashboard');
    } else {
        return "Tu n'as pas les droits";
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return view('home.index', [
            'posts' => $posts,
        ]);
    })->name('home.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('post', PostController::class);
    Route::get('user/{id}', [UserController::class, 'show'])->name('user.index');
    Route::get('follower', [followerController::class, 'index'])->name('follower.index');
    Route::get('friend', [friendController::class, 'index'])->name('friend.index');
    Route::delete('friend/{id}', [friendController::class, 'destroy'])->name('friend.destroy');
    Route::post('friend/{id}', [friendController::class, 'store'])->name('friend.store');
    Route::get('message', [MessageController::class, 'index'])->name('message.index');
    Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::post('likePost/{post}', [LikeController::class, 'index'])->name('likePost');
});

require __DIR__ . '/auth.php';
