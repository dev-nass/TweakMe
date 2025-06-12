<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retweak extends Model
{
    
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

     //
    public function notification()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
