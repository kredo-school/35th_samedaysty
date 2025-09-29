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
use App\Models\Notification;


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
    /**  relation */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
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
            ->withPivot('status', 'joined_at')
            ->withTimestamps();
    }

    /**
     * ユーザーの通知
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * 未読通知
     */
    public function unreadNotifications(): HasMany
    {
        return $this->hasMany(Notification::class)->where('read', false);
    }

    /**
     * 未読通知数
     */
    public function unreadNotificationsCount(): int
    {
        return $this->unreadNotifications()->count();
    }

}
