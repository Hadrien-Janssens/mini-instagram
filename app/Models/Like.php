<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function user_like()
    {
        return $this->belongsTo(User::class);
    }
    public function post_like()
    {
        return $this->belongsTo(Post::class);
    }
}
