<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Gadget;
use App\Models\Reaction;
use App\Models\TravelPlan;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
        'role_id',
    ];

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
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    /**
     * Check if user is normal user
     *
     * @return bool
     */
    public function isNormalUser(): bool
    {
        return $this->role_id === 2;
    }

    /**
     * Get role name
     *
     * @return string
     */
    public function getRoleName(): string
    {
        return match ($this->role_id) {
            1 => 'Admin',
            2 => 'Normal User',
            default => 'Unknown'
        };
    }

    /**
     * Get conversations where user is user1
     */
    public function conversationsAsUser1(): HasMany
    {
        return $this->hasMany(Conversation::class, 'user1_id');
    }

    /**
     * Get conversations where user is user2
     */
    public function conversationsAsUser2(): HasMany
    {
        return $this->hasMany(Conversation::class, 'user2_id');
    }

    /**
     * Get all conversations for the user
     */
    public function conversations()
    {
        return $this->conversationsAsUser1->merge($this->conversationsAsUser2);
    }

    /** Get messages sent by the user */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    /** Get recommended items */
    public function gadgets()
    {
        return $this->hasMany(Gadget::class);
    }
    /**  About follow and Follower */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
            ->wherePivot('status', 'accepted');;
    }
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
            ->wherePivot('status', 'accepted');
    }
    //method
    public function isFollowing(User $user)
    {
        return Follow::where('follower_id', $this->id)
            ->where('following_id', $user->id)
            ->where('status', 'accepted')
            ->exists();
    }

    public function isPending(User $user)
    {
        return Follow::where('follower_id', $this->id)
            ->where('following_id', $user->id)
            ->where('status', 'pending')
            ->exists();
    }
    /**  relation */
    public function followingRequests()
    {
        return $this->hasMany(Follow::class, 'follower_id')
            ->where('status', 'pending');
    }
    public function followerRequests()
    {
        return $this->hasMany(Follow::class, 'following_id')
            ->where('status', 'pending');
    }

    public function travelPlans(): HasMany
    {
        return $this->hasMany(TravelPlan::class);
    }
    /**  to show travel plan on profile page */
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
    /**  to get only interested plan on profile page */
    public function interestedPlans()
    {
        return $this->belongsToMany(
            TravelPlan::class,
            'reactions',
            'user_id',
            'plan_id'
        )
            ->wherePivot('type', 'interested')
            ->withTimestamps();
    }
    /**  to get only liked plan on profile page */
    public function likedPlans()
    {
        return $this->belongsToMany(TravelPlan::class, 'reactions', 'user_id', 'plan_id')
            ->wherePivot('type', '=', 'like')
            ->withTimestamps();
    }


    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function joinedPlans()
    {
        return $this->belongsToMany(TravelPlan::class, 'participations')
            ->wherePivot('status', 'accepted')
            ->withPivot('status', 'joined_at')
            ->withTimestamps();
    }
}
