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

    
    // Requests the user has sent
    public function friendRequestsSent()
    {
        return $this->belongsToMany(User::class, 'add_friend_requests', 'sender_id', 'receiver_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    /**
     * Retrieves the attributes of the user who sent the request,
     * to access the record from the add friend requests table use (->pivot->sender_id)
    */
    public function friendRequestsReceived()
    {
        return $this->belongsToMany(User::class, 'add_friend_requests', 'receiver_id', 'sender_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    /**
     * Friends: both sent and received requests that are accepted
     * We are merging the collection from friendRequestsSent,
     * and freidnRequestReceived
    */
    public function friends()
    {
        $sent = $this->belongsToMany(User::class, 'add_friend_requests', 'sender_id', 'receiver_id')
            ->wherePivot('status', 'accepted');

        $received = $this->belongsToMany(User::class, 'add_friend_requests', 'receiver_id', 'sender_id')
            ->wherePivot('status', 'accepted');

        return $sent->get()->merge($received->get());
    }
}
