<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use function PHPUnit\Framework\returnValueMap;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Retrieves the users posts, if
     * there's any
     */
    public function posts()
    {
        return $this->hasMany(Post::class)
            ->orderByDesc('created_at');
    }


    /**
     * Retrieves the users retweak, if
     * there's any
     */
    public function retweaks()
    {
        return $this->hasMany(Post::class)->whereNotNull('parent_id');
    }


    /**
     * Retrieves the user's bookmarked posts,
     * if there's any
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }


    /**
     * Retrieves the user's liked posts,
     * if there's any
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    //
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function friendRequests()
    {
        return $this->hasMany(AddFriendRequest::class, 'receiver_id')
            ->where('status', '=', 'pending');
    }

    /**
     * Retrieves all friends of the user
     */
    public function friends()
    {
        return $this->hasMany(AddFriendRequest::class, 'receiver_id')
            ->where('status', '=', 'accepted');
    }
}
