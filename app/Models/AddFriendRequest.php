<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddFriendRequest extends Model
{
    /** @use HasFactory<\Database\Factories\AddFrientRequestFactory> */
    use HasFactory;

    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
