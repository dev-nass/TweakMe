<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $casts = [
        'data' => 'array',
    ];

    
    public function notifiable()
    {
        return $this->morphTo();
    }
}
