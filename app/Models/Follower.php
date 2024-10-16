<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;


    public function user_follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function user_followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
