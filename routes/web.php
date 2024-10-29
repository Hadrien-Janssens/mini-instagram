<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\followerController;
use App\Http\Controllers\friendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\NotificationsMiddleware;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
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


Route::middleware(['auth', NotificationsMiddleware::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('post', PostController::class);

    Route::get('user/{id}', [UserController::class, 'index'])->name('user.index');

    Route::get('follower', [FollowerController::class, 'index'])->name('follower.index');

    Route::get('friend', [friendController::class, 'index'])->name('friend.index');
    Route::delete('friend/{id}', [friendController::class, 'destroy'])->name('friend.destroy');
    Route::post('friend/{id}', [friendController::class, 'store'])->name('friend.store');

    Route::get('conversation', [ConversationController::class, 'index'])->name('conversation.index');
    Route::post('conversation/{user}',  [ConversationController::class, 'create'])->name('conversation.create');

    Route::post('likePost/{post}', [LikeController::class, 'index'])->name('likePost');

    Route::resource('comment', CommentController::class);
    // Route::resource('message', MessageController::class);
    Route::get('message/{conversation}', [MessageController::class, 'show'])->name('message.show');
    Route::post('message/{user}', [MessageController::class, 'store'])->name('message.store');


    // Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::resource('notification', NotificationController::class);

    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
});

require __DIR__ . '/auth.php';
